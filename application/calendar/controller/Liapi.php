<?php

namespace app\calendar\controller;

use think\Db;
use think\facade\App;

class Liapi extends Adminapi {

    public function startTransfer() {
        // dump(input("post."));
        $this->apiReturnSuccess(0);
    }
}
