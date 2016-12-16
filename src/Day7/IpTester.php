<?php


namespace App;


class IpTester
{

    public function isAbbaGiven($string)
    {
        preg_match('/(\w)(\w)\2{1,}\1/', $string, $matches);

        return isset($matches[0]) && ($matches[0][0] !== $matches[0][1]);
    }

    public function supportsTsl($ip)
    {
        $abbaOutsideHypernet = preg_match('/([a-z])(?!\1)([a-z])\2\1/', $ip); // Find ABBA
        $abbaInHypernet = preg_match('/\[[a-z]*([a-z])(?!\1)([a-z])\2\1[a-z]*\]/', $ip);

        return $abbaOutsideHypernet && !$abbaInHypernet;
    }

    public function howManyIpsSupport($type, $input)
    {
        $list = explode("\n", $input);
        $list = array_map("trim", $list);
        $method = "supports" . $type;

        $validIpAddresses = array_filter($list, function ($ip) use ($method) {
            return $this->{$method}($ip);
        });

        return count($validIpAddresses);
    }

    public function supportsSsl($ip)
    {
        $supernetResult = preg_match_all('/([a-z])(?!\1)(?=([a-z])\1)(?![a-z]*\])/', $ip, $supernetMatches);
        $hypernetResult = preg_match_all('/\[[a-z]*\]/', $ip, $hypernetMatches);
        if (empty($supernetResult)) {
            return false;
        }
        foreach ($supernetMatches[0] as $i => $aba) {
            $fullHypernet = implode('', $hypernetMatches[0]);
            $pos = strpos($fullHypernet, $supernetMatches[2][$i] . $supernetMatches[1][$i] . $supernetMatches[2][$i]);
            if ($pos !== false) {
                return true;
            }
        }
        return false;
    }
}