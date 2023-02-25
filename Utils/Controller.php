<?php

namespace Utils;

class Controller
{
    public function required(array $body) {
        foreach($body as $key) {
            if (Request::input($key) == null) {
                Response::json([
                    'status' => false,
                    'message' => "$key is required",
                    'is_validation' => true,
                ], 412);

                die(412);
            }
        }
    }
}