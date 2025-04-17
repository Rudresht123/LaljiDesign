<?php
if (!function_exists('autoAlert')) {
    function autoAlert($errors = null)
    {
        $output = '';

        // Success message
        if (session()->has('success')) {
            $messages = session('success');
            if (is_array($messages)) {
                $messages = implode(' ', $messages); // Join array elements as a string
            }
            $output .= "<script>
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 3); // Alert auto-dismiss after 3 seconds
                alertify.success('{$messages}');
            </script>";
        }

        // Error message
        if (session()->has('error')) {
            $messages = session('error');
            if (is_array($messages)) {
                $messages = implode(' ', $messages); // Join array elements as a string
            }
            $output .= "<script>
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 3); // Alert auto-dismiss after 3 seconds
                alertify.error('{$messages}');
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

