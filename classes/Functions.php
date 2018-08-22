<?php
    namespace System\Classes;
    class Functions {
        public function bootstrapAlert($type, $message) {
            $error = "<div class=\"alert alert-$type\"><strong>$message</strong></div>";
            return $error;
        }
    }
