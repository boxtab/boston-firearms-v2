<?php

namespace App\Http\Controllers;

use App\Actions\CheckoutConfirmAction;
use App\Channels\ContactListAddChannel;
use App\Channels\EmailChannel;
use App\Constants\PaymentConstants;
use App\Constants\ResultPerPageConstant;
use App\Constants\RoleAdminConstant;
use App\Constants\RoleInstructorConstant;
use App\Helpers\CertificateHelper;
use App\Helpers\DateTimeHelper;
use App\Helpers\HashHelper;
use App\Helpers\StringHelper;
use App\Models\Appointment;
use App\Models\Blacklist;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Event;
use App\Models\User;
use App\Notifications\AbandonedCheckout;
use App\Notifications\ContactUs;
use App\Notifications\UpcomingAppointment;
use App\Settings\SendGrid\SendGridSettings;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\Filter\FilterException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use setasign\Fpdi\PdfReader\PdfReaderException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

/**
 * Class TestController
 * @package App\Http\Controllers
 */
class TestController extends Controller
{
    public function index()
    {
        return '<br>Test<br>';
    }
}
