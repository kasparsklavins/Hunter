<?php

namespace Hunter;

class Formatter
{
    public static function problem($problem)
    {
        return (object)array(
            "id"          => $problem["pid"],
            "number"      => $problem["num"],
            "title"       => $problem["title"],
            "dacu"        => $problem["dacu"],
            "bestRuntime" => $problem["mrun"],
            "verdicts"    => array(
                Status::NO_VERDICT          => $problem["nover"],
                Status::SUBMISSION_ERROR    => $problem["sube"],
                Status::CANT_BE_JUDGED      => $problem["noj"],
                Status::IN_QUEUE            => $problem["inq"],
                Status::COMPILATION_ERROR   => $problem["ce"],
                Status::RESTRICTED_FUNCTION => $problem["rf"],
                Status::RUNTIME_ERROR       => $problem["re"],
                Status::OUTPUT_LIMIT        => $problem["ole"],
                Status::TIME_LIMIT          => $problem["tle"],
                Status::MEMORY_LIMIT        => $problem["mle"],
                Status::WRONG_ANSWER        => $problem["wa"],
                Status::PRESENTATION_ERROR  => $problem["pe"],
                Status::ACCEPTED            => $problem["ac"],
            ),
            "limit"       => $problem["rtl"],
            "status"      => $problem["status"],
        );
    }

    public static function submission($submission)
    {
        return (object)array(
            "id"       => $submission["sid"],
            "user"     => $submission["uid"],
            "problem"  => $submission["pid"],
            "verdict"  => $submission["ver"],
            "language" => $submission["lan"],
            "runtime"  => $submission["run"],
            "rank"     => $submission["rank"],
            "time"     => $submission["sbt"],
            "name"     => $submission["name"],
            "username" => ($submission["uname"] === "--- ? ---") ? null : $submission["uname"],
        );
    }

    public static function userSubmission($submission, $user, $name, $username)
    {
        return (object)array(
            "id"       => $submission[0],
            "user"     => $user,
            "problem"  => $submission[1],
            "verdict"  => $submission[2],
            "language" => $submission[5],
            "runtime"  => $submission[3],
            "time"     => $submission[4],
            "rank"     => $submission[6],
            "name"     => $name,
            "username" => ($username === "--- ? ---") ? null : $username,
        );
    }

    public static function ranklist($user)
    {
        return (object)array(
            "name"        => $user["name"],
            "username"    => ($user["username"] === "--- ? ---") ? null : $user["username"],
            "rank"        => $user["rank"],
            "accepted"    => $user["ac"],
            "submissions" => $user["nos"],
            "activity"    => $user["activity"],
        );
    }
}