<?php
require_once __DIR__ . '/patterns.php';

trait Services {
    use GlobalStore {
        GlobalStore::getOne as with;
        GlobalStore::setMany as configure;
    }
}

trait Config {
    use GlobalStore {
        GlobalStore::getOne as get;
        GlobalStore::setMany as set;
    }
}
?>
