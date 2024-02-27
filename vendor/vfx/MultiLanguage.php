<?php

namespace vfx;

use vfx\models\Language;
use vfx\traits\Singleton;

class MultiLanguage
{
    use Singleton;

    protected int $id;
    protected string $title;
    protected string $code;
    protected string $encoding;
    protected string $locale;
    protected string|null $slug;
    public function title(): string
    {
        return $this->title;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function encoding(): string
    {
        return $this->encoding;
    }

    public function locale(): string
    {
        return $this->locale;
    }

    public function id(): int|null
    {
        return $this->id ?? null;
    }

    public function slug(): string|null
    {
        return $this->slug ?? null;
    }

    private function getLanguages(): array
    {
        $language = new Language();
        return $language->select()->where('status', '=', 1)->order('sort_order DESC')->get();
    }

    public function start(): void
    {
        $lang_slug = App::$request->segment(0) ?? null;

        $detected_language = new Language();
        $default_language = new Language();

        $detected_language = $detected_language->select()->where('code', '=', $lang_slug)->get('fetch');
        $default_language = $default_language->select()->where('base', '=', 1)->whereNull('slug')->get('fetch');

        $language = !empty($detected_language) ? $detected_language : $default_language;

        if(!empty($language)) {
            $this->id = $language['id'];
            $this->title = $language['title'];
            $this->code = $language['code'];
            $this->encoding = $language['encoding'];
            $this->locale = $language['locale'];
            $this->slug = $language['slug'];

            App::$app->setProperty('languages', $this->getLanguages());
            App::$app->setProperty('language_id', $this->id);
            App::$app->setProperty('locale', $this->locale);
            App::$app->setProperty('language_slug', $this->slug);
            if (strlen($lang_slug) === 2 && $this->slug !== $lang_slug){
                throw new \Exception("Error 404", 404);
            }
        }
    }

}
