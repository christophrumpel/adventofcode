<?php


use App\RoomEncrypter;
use PHPUnit\Framework\TestCase;

class RoomEncrypterTest extends TestCase
{

    /**
     * @test
     */
    public function it_tells_if_a_room_is_real()
    {
        $roomEncrypter = new RoomEncrypter();


        $this->assertTrue($roomEncrypter->isRoomReal("aaaaa-bbb-z-y-x-123[abxyz]"));
        $this->assertTrue($roomEncrypter->isRoomReal("a-b-c-d-e-f-g-h-987[abcde]"));
        $this->assertTrue($roomEncrypter->isRoomReal("not-a-real-room-404[oarel]"));
        $this->assertFalse($roomEncrypter->isRoomReal("totally-real-room-200[decoy]"));
    }

    /**
     * @test
     */
    public function it_calculates_sum_of_real_rooms()
    {
        $roomEncrypter = new RoomEncrypter();
        $input = "aaaaa-bbb-z-y-x-123[abxyz]
       a-b-c-d-e-f-g-h-987[abcde]";

        $sum = $roomEncrypter->getSumOfRealRooms($input);

        $this->assertEquals($sum, 1110);
    }

    /**
     * @test
     */
    public function it_decrypts_the_room_name()
    {
        $roomEncrypter = new RoomEncrypter();
        $roomName = "qzmt-zixmtkozy-ivhz-343[abndh]";

        $this->assertEquals($roomEncrypter->decodeRoomName($roomName), "very encrypted name(343)");
    }
}