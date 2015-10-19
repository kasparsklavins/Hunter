<?php

namespace Hunter;

use PHPUnit_Framework_TestCase;

class HunterTest extends PHPUnit_Framework_TestCase
{
    public function testGetIdFromUsername()
    {
        $hunter = new Hunter();

        $id = $hunter->getIdFromUsername('Kaspars');

        $this->assertInternalType('int', $id);
    }

    public function testInvalidGetIdFromUsername()
    {
        $hunter = new Hunter();

        $id = $hunter->getIdFromUsername('Q');

        $this->assertNull($id);
    }

    public function testSourceTrailingSlash()
    {
        $hunter = new Hunter();

        $hunter->setSource('http://icpcarchive.ecs.baylor.edu/uhunt/api');
        $source = $hunter->getSource();

        $this->assertEquals(substr($source, -1), '/');
    }

    public function testGetAllProblems() // TODO Insert `First World Problems` joke
    {
        $hunter = new Hunter();

        $problems = $hunter->problems();

        $this->assertInternalType('array', $problems);
    }

    public function testGetSingleProblem()
    {
        $hunter = new Hunter();

        $problem = $hunter->problem(100);

        $this->assertInternalType('array', $problem);
        $this->assertCount(9, array_keys($problem));
    }

    public function testGetProblemSubmissions()
    {
        $hunter = new Hunter();

        $submissions = $hunter->problemSubmissions(100);

        $this->assertInternalType('array', $submissions);
    }

    public function testProblemRanklist()
    {
        $hunter = new Hunter();

        $submissions = $hunter->problemRanklist(100, 1, 10);

        $this->assertInternalType('array', $submissions);
        $this->assertCount(10, array_keys($submissions));
    }

    public function testUserProblemRanklist()
    {
        $hunter = new Hunter();

        $submissions = $hunter->userProblemRanklist(36, 343417, 10, 10);

        $this->assertInternalType('array', $submissions);
        $this->assertCount(21, array_keys($submissions));
    }

    public function testUserSubmissions()
    {
        $hunter = new Hunter();

        $submissions = $hunter->userSubmissions(343417);

        $this->assertInternalType('array', $submissions);
    }

    public function testUserLatestSubmissions()
    {
        $hunter = new Hunter();

        $submissions = $hunter->userLatestSubmissions(343417, 10);

        $this->assertInternalType('array', $submissions);
    }

    public function testUserProblemSubmissions()
    {
        $hunter = new Hunter();

        $submissions = $hunter->userProblemSubmissions(343417, 36);

        $this->assertInternalType('array', $submissions);
    }
}
