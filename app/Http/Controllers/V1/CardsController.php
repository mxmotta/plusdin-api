<?php

namespace App\Http\Controllers\V1;

use App\Card;
use App\Category;
use App\Filters\CardsFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CardsController extends Controller
{

    /**
     * List cards
     * @param $filter string
     * @return json
     */
    public function list(CardsFilter $filter){

        $cards = Card::filter($filter)
            ->select([
                'id',
                'name',
                'brand'
            ])
            ->addSelect(['category' => Category::select('name')
                ->whereColumn('category_id', 'categories.id')
                ->limit(1)
            ])
            ->orderBy('name')
            ->paginate(10);

        return response()->json($cards);
    }

    /**
     * Create card
     * @param $request Request
     * @return json
     */
    public function create(CardsRequest $request)
    {
        $card = Card::create($request->all());
        $file = $request->file('image')->store('card/' . $card->id);

        $card->fill(['image' => $file])->save();

        if ($card) {
            return response()->json([
                'success' => true,
                'msg' => 'Card created successfully!',
                'data' => $card
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Internal error, try again later!'
            ], 500);
        }
    }

    /**
     * Update card
     * @param $request Request
     * @param $id integer
     * @return json
     */
    public function update($id, CardsRequest $request)
    {
        try{
            $card = Card::find($id);
            $data = $request->input();
            
            Storage::delete($card->image);
            $file = $request->file('image')->store('card/' . $card->id);
            
            $data['image'] = $file;
            
            if ($card) {
                $card->fill($data)->save();

                return response()->json([
                    'success' => true,
                    'msg' => 'Card created successfully!',
                    'data' => $card
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => "Card not found!"
                ], 404);
            }
        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'msg' => 'Internal error, try again later!'
            ], 500);
        }
    }

    
    /**
     * Get card
     * @param $id integer
     * @return json
     */
    public function get($id){

        
        try{
            $card = Card::select([
                    'name',
                    'image',
                    'brand',
                    'limit',
                    'annual_fee',
                    'created_at',
                    'updated_at'
                ])
                ->addSelect(['category' => Category::select('name')
                    ->whereColumn('category_id', 'categories.id')
                    ->limit(1)
                ])
                ->where('id', $id)
                ->first();

            if($card){
                return response()->json($card);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => "Card not found!"
                ], 404);
            }
            
        }catch (\Exception $e){
            return response()->json([
                'success'   => false,
                'msg'       => "Internal error, try again later!",
                "error"     => $e
            ], 500);
        }
    }

    /**
     * Delete card
     * @param $id integer
     * @return json
     */
    public function delete($id){

        $card = Card::find($id);

        if($card){
            try{
                $card->delete();
                Storage::delete($card->image);
            
                return response()->json([
                    'success' => true,
                    'msg' => 'Card successfully deleted'
                ], 200);
            }catch (\Exception $e){
                return response()->json([
                    'success'   => false,
                    'msg'       => "Internal error, try again later!",
                    "error"     => $e
                ], 500);
            }
        }
        return response()->json([
            'success' => false,
            'msg' => "Card not found!"
        ], 404);
    }

}