<?php
if (!function_exists('autoAlert')) {
    function autoAlert($errors = null)
    {
        $output = '';

        // Success message
        if (session()->has('success')) {
            $message = session('success');
            $output .= "<script>
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 3); // Alert auto-dismiss after 3 seconds
                alertify.success('{$message}');
            </script>";
        }

        // Error message
        if (session()->has('error')) {
            $message = session('error');
            $output .= "<script>
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 3); // Alert auto-dismiss after 3 seconds
                alertify.error('{$message}');
            </script>";
        }

        // Validation errors
        if ($errors && $errors->any()) {
            $output .= "<script>
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 3); // Alert auto-dismiss after 3 seconds";
            
            foreach ($errors->all() as $error) {
                $output .= "alertify.error('{$error}');";
            }

            $output .= "</script>";
        }

        echo $output;
    }
}
