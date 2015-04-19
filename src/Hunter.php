<?php

namespace Hunter;

class Hunter
{
    /**
     * Location of the API data
     *
     * @var string
     */
    private $location = "http://uhunt.felix-halim.net/api/";

    /**
     * Create a new instance
     *
     * @param string $location
     */
    public function __construct($location = null)
    {
        if (is_null($location) === false) {
            $this->location = $location;
        }
    }

    /**
     * Service will return the user ID of given username.
     *
     * @param string $username
     * @return int
     */
    public function getIdFromUsername($username)
    {
        return $this->load("uname2uid", $username);
    }


    /**
     * Returns the list of problems at UVa.
     *
     * @return array
     */
    public function problems()
    {
        $rawProblems = $this->load("p");
        $problems = array();

        foreach ($rawProblems as $problem) {
            $problems[] = Helper\formatProblem($problem, false);
        }

        return $problems;
    }

    /**
     * View a specific problem.
     *
     * @param int    $id
     * @param string $type accepted values are "id" and "num".
     * @return \stdClass
     */
    public function problem($id, $type = "id")
    {
        $problem = $this->load("p", array($type, $id));
        return Helper\formatProblem($problem);
    }

    /**
     * View submissions to specific problems on a given submission date range.
     *
     * @param array|int $problems
     * @param int       $start Unix timestamp.
     * @param int       $end   Unix timestamp.
     * @return array
     */
    public function problemSubmissions($problems, $start = 0, $end = 2147483648)
    {
        if (is_array($problems) === false) {
            $problems = array($problems);
        }

        $rawSubmissions = $this->load("p/subs", array($problems, $start, $end));
        $submissions = array();

        foreach ($rawSubmissions as $submission) {
            $submissions[] = Helper\formatSubmission($submission);
        }

        return $submissions;
    }

    /**
     * Returns submissions to a problem ranked from $rank to $rank + $count - 1.
     *
     * @param int $problem
     * @param int $rank
     * @param int $count
     * @return array
     */
    public function problemRanklist($problem, $rank = 1, $count = 100)
    {
        $rawSubmissions = $this->load("p/rank", array($problem, $rank, $count));
        $submissions = array();

        foreach ($rawSubmissions as $submission) {
            $submissions[] = Helper\formatSubmission($submission);
        }

        return $submissions;
    }

    /**
     * Returns nearby submissions (by runtime) for a particular user submission to a problem.
     *
     * @param int $problem
     * @param int $user
     * @param int $above
     * @param int $below
     * @return array
     */
    public function userProblemRanklist($problem, $user, $above = 10, $below = 10)
    {
        $rawSubmissions = $this->load("p/ranklist", array($problem, $user, $above, $below));
        $submissions = array();

        foreach ($rawSubmissions as $submission) {
            $submissions[] = Helper\formatSubmission($submission);
        }

        return $submissions;
    }

    /**
     * Returns all of the submissions of a particular user.
     *
     * @param int $user
     * @param int $min
     * @return array
     */
    public function userSubmissions($user, $min = null)
    {
        if (is_null($min)) {
            $rawSubmissions = $this->load("subs-user", $user);
        } else {
            $rawSubmissions = $this->load("subs-user", array($user, $min));
        }

        $submissions = array();

        foreach ($rawSubmissions["subs"] as $submission) {
            $submissions[] = Helper\formatUserSubmission(
                $submission,
                $user,
                $rawSubmissions["name"],
                $rawSubmissions["name"]
            );
        }

        return $submissions;
    }

    /**
     * Returns the last $count submissions of a particular user.
     *
     * @param int $user
     * @param int $count
     * @return array
     */
    public function userLatestSubmissions($user, $count = 10)
    {
        $rawSubmissions = $this->load("subs-user-last", array($user, $count));

        $submissions = array();

        foreach ($rawSubmissions["subs"] as $submission) {
            $submissions[] = Helper\formatUserSubmission(
                $submission,
                $user,
                $rawSubmissions["name"],
                $rawSubmissions["uname"]
            );
        }

        return $submissions;
    }

    /**
     * Returns all the submissions of the users on specific problems.
     *
     * @param array|int $users
     * @param array|int $problems
     * @param int       $min
     * @param string    $type
     * @return array
     */
    public function userProblemSubmissions($users, $problems, $min = 0, $type = "id")
    {
        if (is_array($users) === false) {
            $users = array($users);
        }
        if (is_array($problems) === false) {
            $problems = array($problems);
        }

        if ($type === "id") {
            $rawSubmissions = $this->load("subs-pids", array($users, $problems, $min));
        } else {
            $rawSubmissions = $this->load("subs-nums", array($users, $problems, $min));
        }
        $users = array();

        foreach ($rawSubmissions as $id => $user) {
            foreach ($user["subs"] as $submission) {
                $users[$id][] = Helper\formatUserSubmission(
                    $submission,
                    $id,
                    $user["name"],
                    $user["uname"]
                );
            }
        }

        return $users;
    }

    /**
     * Get The Bit-Encoded-Problem IDs that Has Been Solved by Some Authors.
     *
     * @param array|int $users
     * @return array
     */
    public function userSolvedProblems($users)
    {
        if (is_array($users) === false) {
            $users = array($users);
        }
        $rawSolved = $this->load("solved-bits", array($users));
        $users = array();

        foreach ($rawSolved as $user) {
            $users[$user["uid"]] = $user["solved"];
        }

        return $users;
    }

    /**
     * Returns the user's ranklist and their neighbors.
     *
     * @param int $user
     * @param int $above
     * @param int $below
     * @return array
     */
    public function userRanklist($user, $above = 10, $below = 10)
    {
        $rawUsers = $this->load("ranklist", array($user, $above, $below));
        $users = array();

        foreach ($rawUsers as $user) {
            $users[] = Helper\formatRanklist($user);
        }

        return $users;
    }

    /**
     * Global ranklist.
     *
     * @param int $pos
     * @param int $count
     * @return array
     */
    public function ranklist($pos = 1, $count = 10)
    {
        $rawUsers = $this->load("rank", array($pos, $count));
        $users = array();

        foreach ($rawUsers as $user) {
            $users[] = Helper\formatRanklist($user);
        }

        return $users;
    }

    /**
     * Reads & decodes data from the specified node.
     *
     * @param string    $node
     * @param array|int $arguments
     * @return mixed
     */
    private function load($node, $arguments = array())
    {
        if (is_array($arguments) === false) {
            $arguments = array($arguments);
        }
        if (empty($arguments)) {
            $response = file_get_contents($this->location . $node);
        } else {
            foreach ($arguments as &$argument) {
                if (is_array($argument)) {
                    $argument = implode(",", $argument);
                }
            }
            $response = file_get_contents($this->location . $node . "/" . implode("/", $arguments));
        }

        return json_decode($response, true);
    }
}