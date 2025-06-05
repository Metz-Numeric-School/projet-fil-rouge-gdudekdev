<?php

namespace Src;

class Test
{
      public static function test()
      {
            $test = [
                  'email' => 'admin',
                  'password' => 1234,
            ];
            return json_encode($test);
      }
      public static function token()
      {
            return "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImtpZCI6ImNhcnBvb2wta2V5LWlkLWdkdWRlay1kZXYifQ.eyJpc3MiOiJodHRwOi8vY2FycG9vbCIsImF1ZCI6Imh0dHA6Ly9sb2NhbGhvc3Q6NTE3MyIsImlhdCI6MTc0ODkzNTU3MiwiZXhwIjoxNzQ4OTM5MTcyLCJzdWIiOjF9.0WxFPnfovEKPzWQf67gOJalE6x9cxOvYZBe0chDTKAN2Xai2_dzEHKUoQW1MO4RtYDaSjqG0i91Na2SJU15px8HvbG-lrJg-7KaHZWFF7ODyVb4G2aFlHfzoZq5jrUK1n3Wi8_YC0p0gsQ_0ocDgteXNFv79NtUKEP9cRtMLI6gR0u8mnXBVCCTJLFfP-l98jpziS_DS_D0I92_DKq9d7P_wVHsPLaliAzb9WipCKXWJrhhYUUDVlx5iseHk55TYUYfMVwvUaFlIcaAd-uEJTjJKKJzdVHu2TxXIt0ssVi6mZKlEFpSstXgI4HHd9-W46avWoZNpu1USYL26kIPtRA";
      }
}