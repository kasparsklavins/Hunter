<?php

namespace Hunter;

interface HunterInterface
{
    /**
     * Sets the source of API data
     *
     * @param string $source
     */
    public function setSource($source);

    /**
     * Returns the source of API data
     *
     * @return string
     */
    public function getSource();

    /**
     * Service will return the user ID of given username.
     *
     * @param string $username
     *
     * @return int
     */
    public function getIdFromUsername($username);

    /**
     * Returns the list of problems at UVa.
     *
     * @return array
     */
    public function problems();

    /**
     * View a specific problem.
     *
     * @param int    $id
     * @param string $type accepted values are 'id' and 'num'.
     *
     * @return array
     */
    public function problem($id, $type = 'id');

    /**
     * View submissions to specific problems on a given submission date range.
     *
     * @param array|int $problems
     * @param int       $start Unix timestamp.
     * @param int       $end   Unix timestamp.
     *
     * @return array
     */
    public function problemSubmissions($problems, $start = 0, $end = 2147483648);

    /**
     * Returns submissions to a problem ranked from $rank to $rank + $count - 1.
     *
     * @param int $problem
     * @param int $rank
     * @param int $count
     *
     * @return array
     */
    public function problemRanklist($problem, $rank = 1, $count = 100);

    /**
     * Returns nearby submissions (by runtime) for a particular user submission to a problem.
     *
     * @param int $problem
     * @param int $user
     * @param int $above
     * @param int $below
     *
     * @return array
     */
    public function userProblemRanklist($problem, $user, $above = 10, $below = 10);

    /**
     * Returns all of the submissions of a particular user.
     *
     * @param int $user
     * @param int $min
     *
     * @return array
     */
    public function userSubmissions($user, $min = null);

    /**
     * Returns the last $count submissions of a particular user.
     *
     * @param int $user
     * @param int $count
     *
     * @return array
     */
    public function userLatestSubmissions($user, $count = 10);

    /**
     * Returns all the submissions of the users on specific problems.
     *
     * @param array|int $users
     * @param array|int $problems
     * @param int       $min
     * @param string    $type
     *
     * @return array
     */
    public function userProblemSubmissions($users, $problems, $min = 0, $type = 'id');

    /**
     * Get The Bit-Encoded-Problem IDs that Has Been Solved by Some Authors.
     *
     * @param array|int $users
     *
     * @return array
     */
    public function userSolvedProblems($users);

    /**
     * Returns the user's ranklist and their neighbors.
     *
     * @param int $user
     * @param int $above
     * @param int $below
     *
     * @return array
     */
    public function userRanklist($user, $above = 10, $below = 10);

    /**
     * Global ranklist.
     *
     * @param int $pos
     * @param int $count
     *
     * @return array
     */
    public function ranklist($pos = 1, $count = 10);
}
