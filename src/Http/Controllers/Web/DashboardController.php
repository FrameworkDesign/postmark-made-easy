<?php

namespace Weareframework\PostmarkMadeEasy\Http\Controllers\Web;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Artisan;
use Statamic\Facades\Blueprint;
use Statamic\Facades\Site;
use Statamic\Support\Arr;
use Illuminate\Http\Request;
use Statamic\Http\Controllers\CP\CpController;
use Weareframework\PostmarkMadeEasy\Library\Console\Composer;
use Weareframework\PostmarkMadeEasy\Library\Files\File;
use Weareframework\PostmarkMadeEasy\Exceptions\PostmarkMadeEasyException;
use Weareframework\PostmarkMadeEasy\Library\Env\EnvEditor;

class DashboardController extends CpController
{
    /**
     * @var File
     */
    protected $file;

    public function __construct(Request $request, File $file)
    {
        $this->file = $file;
        parent::__construct($request);
    }

    public function index(Request $request): View
    {
        $this->setLocale();
        $blueprint = Blueprint::makeFromSections(config('statamic.postmark-made-easy.settings-blueprint'));
        $fields = $blueprint->fields();
        $values = $this->file->read(false);
        $fields = $fields->addValues($values);
        $fields = $fields->preProcess();
        $fieldValues = $fields->values();

        $env = new EnvEditor();
        $envCurrentContent = $env->getContent();


        if (empty($fieldValues['postmark_made_easy_mail_driver']) && isset($envCurrentContent['MAIL_MAILER'])) {
            $fieldValues['postmark_made_easy_mail_driver'] = $envCurrentContent['MAIL_MAILER'];
        }

        if(!isset($envCurrentContent['POSTMARK_TOKEN'])) {
            $env->addData(['POSTMARK_TOKEN' => '']);
        }

        return view('postmark-made-easy::dashboard.index', [
            'blueprint' => $blueprint->toPublishArray(),
            'values'    => $fieldValues,
            'meta'      => $fields->meta(),
        ]);
    }

    public function update(Request $request)
    {
        $this->setLocale();

        $blueprint = Blueprint::makeFromSections(config('statamic.postmark-made-easy.settings-blueprint'));
        $fields = $blueprint->fields()->addValues($request->all());

        // Perform validation. Like Laravel's standard validation, if it fails,
        // a 422 response will be sent back with all the validation errors.
        $fields->validate();

        // Perform post-processing. This will convert values the Vue components
        // were using into values suitable for putting into storage.
        $values = $fields->process()->values();

        $valuesArray = $values->toArray();
        $this->file->write($valuesArray);

        if (isset($valuesArray['postmark_made_easy_mail_driver']) && !empty($valuesArray['postmark_made_easy_mail_driver'])) {
            $env = new EnvEditor();
            $env->changeEnv([
                'MAIL_MAILER' => $valuesArray['postmark_made_easy_mail_driver'],
                'POSTMARK_TOKEN' => $valuesArray['postmark_made_easy_api_key'],
            ]);
        }
        return;
    }

    public function sendTest(Request $request)
    {
        dd('test senttttt');
    }

    public function installOtherPackages()
    {
        Artisan::call('postmark-made-easy:install-packages');
    }

    /**
     * Since we are accessing the files via CP, we need to fetch the
     * current language via a session variable, and set the locale
     *
     * @return void
     */
    private function setLocale()
    {
        $this->file->setLocale(
            session('statamic.cp.selected-site') ?
                Site::get(session('statamic.cp.selected-site'))->locale() :
                Site::current()->locale());
    }
}
