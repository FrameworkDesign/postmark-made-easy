<?php

namespace Weareframework\PostmarkMadeEasy\Http\Controllers\Web;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\SimpleExcel\SimpleExcelReader;
use Statamic\Facades\Collection;
use Statamic\Facades\Config;
use Statamic\Support\Arr;
use Statamic\Facades\Site;
use Illuminate\Http\Request;
use Statamic\Facades\Blueprint;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile;
use Statamic\Http\Controllers\CP\CpController;

class SettingsController extends CpController
{
    public function index(Request $request): View
    {
        return view('env-editor::settings.index');
    }

    public function update(Request $request)
    {
        $fields = $request->all();

    }


}
