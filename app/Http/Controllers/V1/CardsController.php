<?php

namespace App\Http\Controllers\V1;

use App\Card;
use App\Filters\CardsFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardsController extends Controller
{

    public function list(CardsFilter $filter){

        $cards = Card::filter($filter)->paginate(10);

        return response()->json($cards);
    }

}