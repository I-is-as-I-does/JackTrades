<?php
/* This file is part of JackTrades | (c) 2021 I-is-as-I-does */
namespace SSITU\JackTrades\Trades;

class Token implements Token_i
{
    public function timeBased()
    {
        return md5(uniqid(microtime(), true));
    }

    public function sha40char()
    {
        return sha1(rand());
    }

    public function getSecrets($token, $eligiblechars)
    {
        if (!is_array($eligiblechars)) {
            $eligiblechars = str_split($eligiblechars);
        }
        $search = array_intersect($eligiblechars, str_split($token));
        if (empty($search)) {
            return false;
        }
        return $search;
    }
    
    public function withSecret($secretchar, $pool, $tokenlength)
    {
        if (!is_array($pool)) {
            $pool = str_split($pool);
        }
        $base = array_rand(array_flip($pool), $tokenlength);
        $poz = rand(0, $tokenlength-1);
        $base[$poz] = $secretchar;
        return implode('', $base);
    }

    public function b64basic($bytes = 64)
    {
        return base64_encode(random_bytes($bytes));
    }
}