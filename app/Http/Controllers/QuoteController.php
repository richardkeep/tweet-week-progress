<?php

namespace App\Http\Controllers;

use App\Events\FetchQuote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function show()
    {
        function () {
            $data = json_decode(file_get_contents('https://favqs.com/api/qotd'));
            event(new FetchQuote($data->quote));
        }
    }
}
