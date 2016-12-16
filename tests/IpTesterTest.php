<?php

use App\IpTester;
use PHPUnit\Framework\TestCase;

class IpTesterTest extends TestCase
{

    /**
     * @test
     */
    public function it_tells_if_an_IP_is_TSL_supported()
    {
        $ipTester = new IpTester();

        $this->assertTrue($ipTester->supportsTsl("abba[mnop]qrst"));
        $this->assertTrue($ipTester->supportsTsl("avba[mnop]xoox"));
        $this->assertTrue($ipTester->supportsTsl("ioxxoj[asdfgh]zxcvbn"));
        $this->assertTrue($ipTester->supportsTsl("jlscpqhpgglyyscnhj[otivpqjapmzdblqsw]ygtyjhqvwwvfgohon"));
        $this->assertTrue($ipTester->supportsTsl("kftupspkougaaglay[vvwrbrdwspsiapielt]xgwsbslmoxgdsps"));
        $this->assertTrue($ipTester->supportsTsl("eyunqqdlsaasqfbhwpc[fpmanqdfvhrosxaptp]aeyfdxouzzuuuxteclt[ganxlwtfygldvdhoquf]paymaxgcegdvovaqxya[ylnriprhjdnkuntzp]oqfodnpayolcntvpo"));
        $this->assertTrue($ipTester->supportsTsl("cpjonjjebakmiopx[ogrezailvrfeuqvr]ukxauulwfoofbjqj[bwtqbpbrsjongyolbb]owavyvhfpngnfpfkf[fszhirbmxumnkkmkrd]aielausdsxactibzz"));
    }

    /**
     * @test
     */
    public function it_detects_wrong_tsl()
    {
        $ipTester = new IpTester();
        $this->assertFalse($ipTester->supportsTsl("abcd[bddb]xyyx"));
        $this->assertFalse($ipTester->supportsTsl("abba[edde]xyyx"));
        $this->assertFalse($ipTester->supportsTsl("abba[ecde]xyyx[gggg]grgrgegre[cddc]"));
        $this->assertFalse($ipTester->supportsTsl("angtvlxbjvktrfyb[yfbemeevzxxussud]tsrgzeftntnqmuhpnm[mnbyahgcmhytrmmraez]amhdirmpcmbrpdxc"));
        $this->assertFalse($ipTester->supportsTsl("nxfzlcereffzllqhyr[lwtasiislamadrkbv]kswdnqyfhrwhplch"));
        $this->assertFalse($ipTester->supportsTsl("rcjmntavcacietbswz[hpaisjxybnvkckeal]vslmivhtptssuenj[atqzxkjjymznyffhwrn]pcrcqwbdakodyj"));
        $this->assertFalse($ipTester->supportsTsl("xkjzxdynolwurfpyznl[etuwbkgomabfkeul]tlamnotqdzsewnbyr[vdbnclqwaaaxqbwind]gdnogntbrxjtffss"));
        $this->assertFalse($ipTester->supportsTsl("yqdhleetfcqhdiib[eceprgdrrsmbarxdtbq]hdayiijoaaeumfwcdj"));
        $this->assertFalse($ipTester->supportsTsl("cqqvoxzdokmgiwgcks[jqzwdkyjpbdchlt]phkfcoalnhoxnczrru"));
        $this->assertFalse($ipTester->supportsTsl("aiwoefcwoeqwextoxp[bylubaahxfxiesk]hbrtlnaixkrcfgkjbo"));
        $this->assertFalse($ipTester->supportsTsl("luqpeubugunvgzdqk[jfnihalscclrffkxqz]wvzpvmpfiehevybbgpg[esjuempbtmfmwwmqa]rhflhjrqjbbsadjnyc"));
    }

    /**
     * @test
     */
    public function it_detects_4_same_characters_as_wrong()
    {
        $ipTester = new IpTester();
        $this->assertFalse($ipTester->supportsTsl("aaaa[qwer]tyui"));
        $this->assertFalse($ipTester->supportsTsl("sgrrlovxcccckxvfe[ptdjkmmmscxhrppj]caqbirqmphsolnz[zegoqjlxinlxyzzj]lzcrxhmcvsquqrk"));
    }

    /**
     * @test
     */
    public function it_tells_how_many_ips_from_list_are_tsl_supported()
    {
        $ipTester = new IpTester();
        $input = "aaaa[qwer]tyui
        abba[mnop]qrst
        ioxxoj[asdfgh]zxcvbn";

        $input2 = "abba[cddc]effe[aaaa]cooc
        fghejebnnb[grrr]mffjefj[bggb]guggaaaa";

        $this->assertEquals($ipTester->howManyIpsSupport("Tsl", $input), 2);
        $this->assertEquals($ipTester->howManyIpsSupport("Tsl", $input2), 0);
    }

    /**
     * @test
     */
    public function it_detects_multiple_hypernet_sequences()
    {
        $ipTester = new IpTester();
        $ipTrue = "abba[qwer]tyui[xoox]";
        $ipFalse = "abba[qwer]tyui[xdox]";
        $ips = "abba[qwer]tyui[xoox]
        abba[qwer]tyui[xdox]
        ";

        $this->assertFalse($ipTester->supportsTsl($ipTrue));
        $this->assertTrue($ipTester->supportsTsl($ipFalse));
        $this->assertEquals(1, $ipTester->howManyIpsSupport("tsl",$ips));
    }

    /**
     * @test
     */
    public function it_supports_ssl()
    {
        $ipTester = new IpTester();

        $this->assertTrue($ipTester->supportsSsl("aba[bab]xyz"));
        $this->assertFalse($ipTester->supportsSsl("xyx[xyx]xyx"));
        $this->assertTrue($ipTester->supportsSsl("aaa[kek]eke"));
        $this->assertTrue($ipTester->supportsSsl("zazbz[bzb]cdb"));
    }

    /**
     * @test
     */
    public function it_tells_how_many_ips_from_list_support_ssl()
    {
        $ipTester = new IpTester();
        $input = "aba[bab]xyz
        aaa[kek]eke
        xyx[xyx]xyx";

        $this->assertEquals(2, $ipTester->howManyIpsSupport("Ssl", $input));
    }
}