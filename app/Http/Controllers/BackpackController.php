<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackpackController extends Controller
{
    function master(Request $req){
        $search = $req->input('search', '');
        $page = $req->input('page', 1);
        $size = $req->input('size', 5);
        $query = DB::table('public.users as b')
            ->select(
                "id",
                "backpackid",
                "user",
                DB::raw('(
                    SELECT
                        json_agg(node)
                    FROM (
                        SELECT
                            "items","backpack"
                        FROM
                            public.backpack as u
                        WHERE
                            b.backpackid = u.id
                    ) as node
                ) as backpack')
            );
        if(empty($search)){
                $query->where('user', 'LIKE', '%' . '' . '%');
            }
        else if (!empty($search)) {
            $query->where('user', 'LIKE', '%' . $search . '%');
        }
        $data = $query->paginate($size, ['*'], 'page', $page);

        $data->getCollection()->transform(function ($item) {
            $item->backpack = json_decode($item->backpack);
            return $item;
        });

        $resp = ['data' => $data->toArray()];
    
        return response()->json($resp);
    }
    function postusers(Request $req) {
        $search = $req->input('search', '');
        $page = $req->input('page', 1);
        $size = $req->input('size', 5);
        $user = $req->input('user');
        $backpackid = $req->input('backpackid');

        $query = DB::table('public.users')
            ->insert(["user" => $user, "backpackid" => $backpackid]);
            if ($query) {
                $selectquery = DB::table('public.users as b')
                ->select(
                    "id",
                    "backpackid",
                    "user",
                    DB::raw('(
                        SELECT
                            json_agg(node)
                        FROM (
                            SELECT
                                "items","backpack"
                            FROM
                                public.backpack as u
                            WHERE
                                b.backpackid = u.id
                        ) as node
                    ) as backpack')
                );
        if(empty($search)){
            $selectquery->where('user', 'LIKE', '%' . '' . '%');
            }
        else if (!empty($search)) {
            $selectquery->where('user', 'LIKE', '%' . $search . '%');
        }
        $data = $selectquery->paginate($size, ['*'], 'page', $page);

        $data->getCollection()->transform(function ($item) {
            $item->backpack = json_decode($item->backpack);
            return $item;
        });

        $resp = ['data' => $data->toArray()];
    
        return response()->json($resp);
            }
        }
    function putusers(Request $req){
        $search = $req->input('search', '');
        $page = $req->input('page', 1);
        $size = $req->input('size', 5);
        $user = $req->input('user');
        $backpackid = $req->input('backpackid');
        $iduser = $req->input('id');

        $query = DB::table('public.users')->where('id', $iduser)
        ->update(["user" => $user, "backpackid" => $backpackid]);
        if ($query) {
            $selectquery = DB::table('public.users as b')
            ->select(
                "id",
                "backpackid",
                "user",
                DB::raw('(
                    SELECT
                        json_agg(node)
                    FROM (
                        SELECT
                            "items","backpack"
                        FROM
                            public.backpack as u
                        WHERE
                            b.backpackid = u.id
                    ) as node
                ) as backpack')
            );
    if(empty($search)){
        $selectquery->where('user', 'LIKE', '%' . '' . '%');
        }
    else if (!empty($search)) {
        $selectquery->where('user', 'LIKE', '%' . $search . '%');
    }
    $data = $selectquery->paginate($size, ['*'], 'page', $page);

    $data->getCollection()->transform(function ($item) {
        $item->backpack = json_decode($item->backpack);
        return $item;
    });

    $resp = ['data' => $data->toArray()];

    return response()->json($resp);
    }
}
    function deleteusers(Request $req){
        $search = $req->input('search', '');
        $page = $req->input('page', 1);
        $size = $req->input('size', 5);
        $user = $req->input('user');
        $backpackid = $req->input('backpackid');
        $iduser = $req->input('id');

        $query = DB::table('public.users')->where('id', $iduser)
        ->delete();
        if ($query) {
            $selectquery = DB::table('public.users as b')
            ->select(
                "id",
                "backpackid",
                "user",
                DB::raw('(
                    SELECT
                        json_agg(node)
                    FROM (
                        SELECT
                            "items","backpack"
                        FROM
                            public.backpack as u
                        WHERE
                            b.backpackid = u.id
                    ) as node
                ) as backpack')
            );
    if(empty($search)){
        $selectquery->where('user', 'LIKE', '%' . '' . '%');
        }
    else if (!empty($search)) {
        $selectquery->where('user', 'LIKE', '%' . $search . '%');
    }
    $data = $selectquery->paginate($size, ['*'], 'page', $page);

    $data->getCollection()->transform(function ($item) {
        $item->backpack = json_decode($item->backpack);
        return $item;
    });

    $resp = ['data' => $data->toArray()];

    return response()->json($resp);
        }
    }
}
