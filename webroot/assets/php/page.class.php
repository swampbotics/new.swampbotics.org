<?php

final class Page
{
    /**
     * The title of this page
     * Max 60 characters: '| Unique Tech' and possibly additional text is appended
     * @var string
     */
    public $title;

    /**
     * The canonical URL for this page (no parameters)
     * @var string
     */
    public $canonical;

    /**
     * The description for use in meta tags
     * Max 155 characters.
     * @var string
     */
    public $description;

    /**
     * Determines whether output() displays an h1 above the content.
     * If true, the $title will be displayed above the content area but
     * below navigation and breadcrumbs.
     * @var boolean
     */
    public $showh1;

    /**
     * Stores content for the page. This is inserted appropriately by output().
     * @var string
     */
    public $content;

    /**
     * Stores the navigation button to be selected.
     * Select from [Online Support, Knowledge Base, Tickets, Pricing, About, Log In, Register]
     * @var string
     */
    public $navSelected;

    /**
     * Stores security setting for this page
     * Select from 0=public, 1=login, 2=technician
     * @var string
     */
    public $security;

    /**
     * Put additional meta tags here
     * https://developers.facebook.com/docs/reference/opengraph
     * https://schema.org/
     * https://dev.twitter.com/docs/cards
     * @var string
     */
    public $meta;

    /**
     * Stores JS links for this page only (not global)
     * @var string
     */
    public $js;
    public $contentHidden;
    public $footer = true;
    public $nav = true;
    public $header = '';
    public $navType = 'default';
    public $autoContent;
    /**
     * Reads in the global HTML template and fills in the blanks.
     * This function should be the last function called; the script will exit after it runs.
     * @return void
     */
    public function output()
    {
        $thisoutput = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/global.html');
        switch ($this->navType) {
          case 'default':
            $navClass = 'navbar navbar-default ripple-group-parent';
            $navWrapper = 'sticky-navbar';
            break;
          case 'dark-top':
            $navClass = 'navbar navbar-dark navbar-transparent navbar-fixed-top ripple-group-parent init-animation-1';
            $navWrapper = 'transp-nav';
            break;
          case 'dark-middle':
            $navClass = 'navbar navbar-dark ripple-group-parent';
            $navWrapper = 'sticky-navbar';
            break;
        }
        $thisoutput = str_replace('{head}', file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/includes/head.html'), $thisoutput);
        $thisoutput = str_replace('{meta}', $this->meta, $thisoutput);
        if (!empty($this->autoContent)) {
            $thisoutput = str_replace('{header}', file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/headers/'.$this->autoContent.'.html'), $thisoutput);
            $thisoutput = str_replace('{content}', file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/'.$this->autoContent.'.html'), $thisoutput);
        } else {
            $thisoutput = str_replace('{header}', $this->header, $thisoutput);
            $thisoutput = str_replace('{content}', $this->content, $thisoutput);
        }
        $thisoutput = str_replace('{content-hidden}', $this->contentHidden, $thisoutput);
        $thisoutput = str_replace('{title}', $this->title, $thisoutput);
        $thisoutput = str_replace('{canonical}', $this->canonical, $thisoutput);
        $thisoutput = str_replace('{description}', $this->description, $thisoutput);
        if ($this->nav) {
            $thisoutput = str_replace('{nav}', file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/includes/nav.html'), $thisoutput);
            $thisoutput = str_replace('{nav-class}', $navClass, $thisoutput);
            $thisoutput = str_replace('{nav-wrapper}', $navWrapper, $thisoutput);
        } else {
            $thisoutput = str_replace('{nav}', '', $thisoutput);
        }
        if ($this->footer) {
            $thisoutput = str_replace('{footer}', file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/includes/footer.html'), $thisoutput);
        } else {
            $thisoutput = str_replace('{footer}', '', $thisoutput);
        }
        $thisoutput = str_replace('{scripts}', file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/includes/scripts.html'), $thisoutput);
        if ($this->title == "Home") {
            $thisoutput = str_replace('{nav-js}', "<script>$('.navbar-page').hide().remove();</script>", $thisoutput);
        } else {
            $thisoutput = str_replace('{nav-js}', "<script>$('.navbar-index').hide().remove();</script>", $thisoutput);
        }
        $thisoutput = str_replace('{js}', $this->js, $thisoutput);
        echo $thisoutput;
        exit;
    }
}
