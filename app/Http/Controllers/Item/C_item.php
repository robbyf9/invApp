<?php

namespace App\Http\Controllers\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use Validator;


class C_item extends Controller
{

    function __construct()
    {

    }

    public function index()
    {
        $data['items'] = Item::all()->toArray();

        return view('item', $data);
    }

    public function get_item_by_id(Request $request){
        $item = Item::find($request->id)->toArray();

        return response()->json($item);
    }

    public function add_item(Request $request)
    {
        try {
            if (isset($request->barang)) {
                $validator = Validator::make($request->all(), [
                    'barang' => 'required|file|mimes:jpg,jpeg,png|max:1000',
                ]);
    
                if ($validator->fails()) {
                    $respon = [
                        'respon' => $validator->errors()->all(),
                        'responCode' => 0
                    ];
                    return response()->json([$respon]);
                }
    
                if ($request->file('barang')) {
    
                    $imageName = rand() . "." . $request->file('barang')->getClientOriginalExtension();

                    $request->file('barang')->storeAs('public/image/item', $imageName);
                }
            }
    
            $respon = Item::create([
                'nama_item' => $request->nama_item,
                'unit' => $request->unit,
                'stok' => $request->stok,
                'harga_satuan' => $request->harga_satuan,
                'barang' => $imageName
            ]);

            $response = [
                'respon' => 'Item Berhasil Ditambah!',
                'responCode' => 1
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'respon' => 'Oopss... Terjadi Kesalahan!',
                'responCode' => 0
            ];
            return response()->json($response);
        }
    }

    public function edit_item(Request $request)
    {
        $itemData = Item::find($request->id)->toArray();

        try {
            if (isset($request->barang)) {
                $validator = Validator::make($request->all(), [
                    'barang' => 'required|file|mimes:jpg,jpeg,png|max:1000',
                ]);
    
                if ($validator->fails()) {
                    $respon = [
                        'respon' => $validator->errors()->all(),
                        'responCode' => 0
                    ];
                    return response()->json([$respon]);
                }
    
                if ($request->file('barang')) {
    
                    $imageName = rand() . "." . $request->file('barang')->getClientOriginalExtension();

                    $request->file('barang')->storeAs('public/image/item', $imageName);
                    Storage::delete('public/image/item/' . $itemData['barang']);
                } 
            } else {
                
                $imageName = $itemData['barang'];
            }
    
            $item = Item::find($request->id);
            $item->nama_item = $request->nama_item;
            $item->unit = $request->unit;
            $item->stok = $request->stok;
            $item->harga_satuan = $request->harga_satuan;
            $item->barang = $imageName;
            $item->save();

            $response = [
                'respon' => 'Item Berhasil Diubah!',
                'responCode' => 1
            ];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'respon' => 'Oopss... Terjadi Kesalahan!',
                'responCode' => 0
            ];
            return response()->json($response);
        }
        
    }

    public function delete_item(Request $request)
    {
        try {
            $itemData = Item::find($request->id)->toArray();
    
            Item::find($request->id)->delete();
        
            $checkFile = Storage::exists('/public/image/item/' . $itemData['barang']);
    
            if ($checkFile) {
                Storage::delete('public/image/item/' . $itemData['barang']);
            }
    
            $response = [
                'respon' => 'Item Berhasil Dihapus!',
                'responCode' => 1
            ];
    
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'respon' => 'Oopss... Terjadi Kesalahan!',
                'responCode' => 0
            ];
            return response()->json($response);
        }
    }
}