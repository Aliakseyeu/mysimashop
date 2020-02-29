<?php

namespace Tests\Feature;

use Tests\Support\{Prepare, GroupTrait, UserTrait};

class ArchiveTest extends Prepare
{

    use GroupTrait;
    use UserTrait;

    protected $url = '/archive';

    public function testNotAuthedUserCanNotSeeArchivePage(): void
    {
        $response = $this->get($this->url);
        $response->assertRedirect('/login');
    }

    public function testAuthedUserCanSeeArchivePage(): void
    {
        $this->groupToArchive($this->getGroup());
        $response = $this->actingAs($this->getUser())->get($this->url);
        $response->assertOk();
    }
    
}