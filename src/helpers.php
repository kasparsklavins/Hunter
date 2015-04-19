<?php

namespace Hunter\Helper;

use Hunter\Status;

function formatProblem($problem, $associated = true)
{
    if ($associated === false) {
        $problem = array_combine(array(
            "pid", "num", "title", "dacu", "mrun", "mmem", "nover", "sube", "noj", "inq", "ce", "rf", "re", "ole",
            "tle", "mle", "wa", "pe", "ac", "rtl", "status"
        ), $problem);
    }

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

function formatSubmission($submission)
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

function formatUserSubmission($submission, $user, $name, $username)
{
    return formatSubmission(array(
        "sid"   => $submission[0],
        "uid"   => $user,
        "pid"   => $submission[1],
        "ver"   => $submission[2],
        "lan"   => $submission[5],
        "run"   => $submission[3],
        "rank"  => $submission[6],
        "sbt"   => $submission[4],
        "name"  => $name,
        "uname" => $username,
    ));
}

function formatRanklist($user)
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