<?php

namespace App\Services\Specialist;

use Exception;
use PhpOffice\PhpWord\TemplateProcessor;

class PhpOfficceService
{
    public static function getWordDocument($reports, $form, $formFields, $farm)
    {
        $imagePath = public_path().('/storage/ast_logo.png');
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $user = auth()->user();


//        $phpWord->addTableStyle('Fancy Table', [
//            'borderSize' => 0, 'borderColor' => 'ffffff00', 'cellMargin' => 8
//        ]);
        $headerTable = $section->addTable([
            'borderSize' => 0, 'borderColor' => 'ffffff00', 'cellMargin' => 8
        ]);

        $headerTable->addRow(500);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'left'])->addText(htmlspecialchars('АгроСтар-Трейд+'), [
            'bold' => false, 'align' => 'center'
        ]);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'left'])->addText(htmlspecialchars('Консультант-технолог: '.$user->fullName), [
            'bold' => false, 'align' => 'center'
        ]);
        $headerTable->addRow(500);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'right'])->addText(htmlspecialchars('тел: 8 800 600-90-55'), [
            'bold' => false, 'align' => 'center'
        ]);
        $headerTable->addCell(5000, ['valign' => 'center', 'align' => 'right'])->addText(htmlspecialchars('тел: '. $user->phone), [
            'bold' => false, 'align' => 'center'
        ]);

        $section->addTextBreak(1);


        $section->addImage($imagePath, [
            'width'         => 100,
            'height'        => 100,
            'marginTop'     => -1,
            'marginLeft'    => -1,
            'wrappingStyle' => 'behind'
        ]);

        $section->addTextBreak(1);
        $section->addText('', [], ['borderTopSize' => 5]);
        $section->addText($farm->region->name." - ".$farm->organization->name." - ".$form->name. " - ".date('Y-m-d'),[],['lineHeight' => 2]);
        $section->addText('', [], ['borderTopSize' => 5]);

        $section->addText($form->name,['size' => 11, 'bold' => true]);
        $section->addTextBreak(1);

        $styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 8);
        $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '000000', 'bgColor' => '66BBFF');
        $styleCell = array('valign' => 'center');
        $styleCellBTLR = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        $fontStyle = array('bold' => true, 'align' => 'center');
        $phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
        $table = $section->addTable('Fancy Table');
        $table->addRow(900);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('#'), $fontStyle);

        foreach($reports as $key => $report){
            $table->addCell(2000, $styleCell)->addText(htmlspecialchars($key+1), $fontStyle);
        }

        foreach($formFields as $formField){
            $table->addRow();
                $table->addCell(2000)->addText(htmlspecialchars($formField->name));
            foreach($reports as $report){
                $table->addCell(2000)->addText(htmlspecialchars(isset($report->data["field_$formField->id"])) ? $report->data["field_$formField->id"] : ($formField->type==='number' ? '0' : ''));
            }
        }

        $table->addRow();
        $table->addCell(2000)->addText('Дата');
        foreach($reports as $report){
            $table->addCell(2000)->addText(htmlspecialchars(isset($report->date) ? $report->date : ''));
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $name = date('Y-m-d-H-i-s').'_document.docx';
            $objWriter->save(public_path().'/storage/'.$name);
        } catch (Exception $e) {
        }

        return public_path().'/storage/'.$name;
    }
}
