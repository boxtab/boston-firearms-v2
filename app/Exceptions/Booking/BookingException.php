<?php

namespace App\Exceptions\Booking;

use App\Models\Booking;
use Illuminate\Http\Response;
use Exception;

class BookingException extends Exception {

    private string $view;
    private ?string $text;

    private ?Booking $booking;

    /**
     * @param string|null $message
     *
     * @return BookingException
     */
    public static function nonExists(?string $message = null): BookingException
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
            'booking' => $this->booking?? null
        ]);
    }
}
