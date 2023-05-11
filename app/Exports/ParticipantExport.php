<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;

class ParticipantExport extends DefaultValueBinder implements WithStyles, ShouldAutoSize, WithCustomValueBinder
{
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function styles(Worksheet $sheet)
    {
        $year = $this->year;
        $model = [];
        $form = DB::table('setting_forms')->where('status_form', 1)
            ->select('id', 'initial', 'name')
            ->orderBy('order_form', 'ASC')
            ->get();

        DB::table('registrations as ppen')->join('participants as pp', 'pp.id', '=', 'ppen.id_participant')
            ->where('ppen.school_year', 'like', "$year%")
            ->select('pp.name', 'pp.nisn', 'pp.decision', 'ppen.id_participant')
            ->groupBy('ppen.id_participant', 'pp.name', 'pp.nisn', 'pp.decision')
            ->orderBy('ppen.id_participant')
            ->chunk(200, function ($participants) use ($form, &$arr_data, $year) {
                foreach ($participants as $prtcpn) {
                    $model_item = [
                        'id' => $prtcpn->id_participant,
                        'name' => $prtcpn->name,
                        'nisn' => $prtcpn->nisn,
                        'decision' => $prtcpn->decision == 1 ? 'Diterima' : ($prtcpn->decision == 2 ? 'Tidak Diterima' : 'Belum Diputuskan'),
                        'form' => $form,
                    ];

                    // Get the registration values for this participant
                    $reg_participant2 = DB::table('registrations as ppen')
                        ->where('ppen.school_year', 'like', "$year%")
                        ->where('ppen.id_participant', $prtcpn->id_participant)
                        ->select('ppen.id_participant', 'ppen.id_form', 'ppen.value')
                        ->get();

                    $bt = [];
                    foreach ($model_item['form'] as $frm) {
                        $value = $reg_participant2->where('id_form', $frm->id)->first();

                        $bt[] = [
                            'id' => $frm->id,
                            'initial' => $frm->initial,
                            'name' => $frm->name,
                            'value' => empty($value) ? null : $value->value
                        ];
                    }
                    $model_item['form'] = $bt;

                    $arr_data[] = $model_item;
                }
            });
        $form_Column = [];
        foreach ($arr_data as $key => $val) {
            $form = array();
            $form2 = array();
            foreach ($val['form']  as $k => $v) {
                $form[] = $v['name'];
                $form2[] = $v['value'];
            }
            $form_Column[] = $form;
            $form_Cell[]   = $form2;
        }

        $array_column = [];

        foreach ($form_Column[0] as $rx => $vc) {
            $array_column[] = $vc;
        }
        $sheet->fromArray($array_column, null, 'A1');
        $sheet->getDefaultColumnDimension()->setWidth(30);
        $sheet->fromArray($form_Cell, null, 'A2');


        $style_col = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ],
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'FF4F81BD')
            ),
            'font'  => array(
                'color' => array('rgb' => 'FFFFFF'),
            )
        ];

        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->getFont()->setBold(true);
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray($style_col);
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray($style_col);
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
