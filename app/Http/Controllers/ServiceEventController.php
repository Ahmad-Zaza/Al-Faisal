<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\CategoryMenu;
use App\Http\Models\MainInformations;
use App\Http\Models\SectionArera;
use App\Http\Models\SiteMenu;
use App\Seo;
use TCPDF;
use TCPDF_FONTS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class ServiceEventController extends Controller
{
    protected $category_id;
    public function index()
    {
        $lang = App::getLocale();

        $catering_categories = Category::orderBy('created_at')->get();
        $highlight = SectionArera::where('section_id', '=', 7)->first();
        $categories =  Category::all();
        $mainInformations = MainInformations::first();
        $contactUs_section_info = SectionArera::where('section_id', '=', 6)->first();
        $seo = Seo::orderBy('sorting')->get();
        return view('catering-services', compact(['highlight', 'categories', 'mainInformations', 'contactUs_section_info', 'lang', 'catering_categories']));
    }

    public function downloadPDF($id)
    {
        $this->category_id = $id;
        $lang = App::getLocale();
        $category = Category::where('id', '=', $id)->first();
        $sorting = $category['sorting'];
        $next_category = Category::where('sorting', '=', ($sorting + 1))->first();
        $prev_category  = Category::where('sorting', '=', ($sorting - 1))->first();
        $mainInformations = MainInformations::first();
        $catering_categories = Category::orderBy('sorting')->get();
        $category_menus = CategoryMenu::where('category_id', '=', $id)
            ->orderBy('sorting')
            ->get();

        // start pdf code
        $pdf = new MYPDF("P", PDF_UNIT, "A4", true, 'UTF-8', false);
        $pdf->setCategory($category["name_$lang"]);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(1);

        // remove default footer
        $pdf->setPrintFooter(true);
        if ($lang == 'ar') {
            $lg = array();
            $lg['a_meta_charset'] = 'UTF-8';
            $lg['a_meta_dir'] = 'rtl';
            $lg['a_meta_language'] = 'ar';
            $lg['w_page'] = 'page';

            $pdf->setLanguageArray($lg);
            $pdf->setRTL(true);
        }

        $pdf->SetMargins(5, 78, 5);

        // add font
        if ($lang == 'ar') {
            $fontFile = $_SERVER["DOCUMENT_ROOT"] . "Fonts/ar-Regular.ttf";
            $fontname = TCPDF_FONTS::addTTFfont($fontFile, 'TrueTypeUnicode', '');
        } else {
            $fontFile = $_SERVER["DOCUMENT_ROOT"] . "Fonts/SourceSansPro-Regular.ttf";
            $fontname = TCPDF_FONTS::addTTFfont($fontFile, 'TrueTypeUnicode', '');
        }
        // use the font
        $pdf->SetFont($fontname, '', 15, '', false);
        // add page
        $pdf->AddPage();

        $html = view('PDFMenu', compact('lang', 'category', 'catering_categories', 'next_category', 'prev_category', 'mainInformations', 'category_menus'))->render();

        $pdf->writeHTML($html, true, true, true, false, '');
        return $pdf->Output('menu.pdf', 'I');
    }
}

class MYPDF extends TCPDF
{
    protected $category_name;

    public function setCategory($var)
    {
        $this->category_name = $var;
    }
    public function getLang()
    {
        return App::getLocale();
    }
    // Page footer
    public function Footer()
    {

        // $this->setY(-9);
        // $logoX = 0; // 
        // $logoFileName = $_SERVER["DOCUMENT_ROOT"] . 'img/background/pdf1-footer.png';
        // $logoWidth = 210; // 15mm
        // $logo = $this->Image($logoFileName, $logoX, $this->GetY(), $logoWidth);
        // $this->Cell(0, 0, $logo, 0, 0, 'C');
    }

    public function Header()
    {
        $this->SetAutoPageBreak(false, 0);
        $img_file = $_SERVER["DOCUMENT_ROOT"] . 'img/background/Pdf-Background.png';
        $this->Image($img_file, 0, 0, 210, 297, '', '', '', true, 300, '', false, false, 0);
        $this->SetAutoPageBreak(true, 10);
        if ($this->page == 1) {
            $this->SetY(75);
            if ($this->getLang() == 'ar') {
                $fontFile = $_SERVER["DOCUMENT_ROOT"] . "Fonts/ar-Regular.ttf";
                $fontname = TCPDF_FONTS::addTTFfont($fontFile, 'TrueTypeUnicode', '');
            } else {
                $fontFile = $_SERVER["DOCUMENT_ROOT"] . "Fonts/SourceSansPro-Regular.ttf";
                $fontname = TCPDF_FONTS::addTTFfont($fontFile, 'TrueTypeUnicode', '');
            }
            // use the font
            $this->SetFont($fontname, '', 20, '', false);
            $this->Cell(0, 0, $this->category_name, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        }
    }
}
