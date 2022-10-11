<?php


namespace App\Exceptions\Appointment;


use App\Models\Appointment;
use Illuminate\Http\Response;
use Exception;

class AppointmentException extends Exception {

    private string $view;
    private ?string $text;

    private ?Appointment $appointment;

    /**
     * @param string|null $message
     *
     * @return AppointmentException
     */
    public static function nonExists(?string $message = null): AppointmentException
    {
        $e = new static();
        $e->view = 'errors.404';
        $e->text = $message;
        return $e;
    }

    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        return false;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function render($request): Response {

        return response()->view($this->view, [
            'text' => $this->text,
            'appointment' => $this->appointment?? null
        ]);
    }
}
