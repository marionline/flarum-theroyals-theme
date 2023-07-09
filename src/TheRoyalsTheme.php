<?php

namespace Marionline\TheRoyalsTheme;

use Flarum\Foundation\Config;
use Flarum\Frontend\Document;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Arr;

/**
 * Main class for FedoraFrTheme
 */
class TheRoyalsTheme
{
    private const ASSETS_PATH = '/assets/extensions/flarum-theroyals-theme';
    private const COMMON_URI = 'https://www.theroyals.it';

    /**
     * Constructor.
     *
     * @param ViewFactory $factory
     */
    public function __construct(private ViewFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Invocation.
     *
     * @param  Document $document
     */
    public function __invoke(Document $document): void
    {
        $forumApiDocument = $document->getForumApiDocument();

        Arr::set($document->meta, 'theme-color', '#d8dccf');
        // Arr::set(
            // $document->head,
            // 'manifest',
            // '<link rel="manifest" href="' . self::ASSETS_PATH . '/manifest.webmanifest">'
        // );
        // Override favicon with svg.
        // Arr::set(
            // $document->head,
            // 'favicon',
            // '<link rel="icon" href="' . self::COMMON_URI . '/fedora-fr_icon.svg" sizes="any" type="image/svg+xml">'
        // );



        $forumApiDocument['data']['attributes']['headerHtml'] = $this->createHeader();
        $forumApiDocument['data']['attributes']['footerHtml'] = $this->createFooter();

        $document->setForumApiDocument($forumApiDocument);
    }


    /**
     * Footer controler.
     *
     * @return View
     */
    private function createHeader(): View
    {
        return $this->factory->make('theme-theroyals::header');
    }

    /**
     * Footer controler.
     *
     * @return View
     */
    private function createFooter(): View
    {
        return $this->factory->make('theme-theroyals::footer');
    }
}
