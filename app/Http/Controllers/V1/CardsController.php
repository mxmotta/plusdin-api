<?php

namespace App\Http\Controllers\V1;

use App\Card;
use App\Category;
use App\Filters\CardsFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardsController extends Controller
{

    public function list(CardsFilter $filter){

        $cards = Card::filter($filter)
            ->select([
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

    public function create(CardsRequest $request)
    {
        $card = Card::create($request->all());

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

    public function delete($id){

        $card = Card::find($id);

        if($card){
            try{
                $card->delete();
            
                return response()->json([
                    'success' => true,
                    'msg' => 'Card successfully deleted'
                ], 201);
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