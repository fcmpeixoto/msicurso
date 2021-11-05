<?php


namespace App\Relatorios;

use Mpdf\Mpdf;

class ReportListaInscritop extends mpdf
{

    // Atributos da classe
    private $pdf = null;
    /**
     * @var array
     */
    private $data;


    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /*
    * Método para montar o Cabeçalho do relatório em PDF
    */
    protected function getHeader()
    {
        $data = date('d/m/Y');
        $retorno = "<table  width=\"1000\">  
               <tr>  
                 <td align=\"center\"><h4 class='text-center'>Lista de Inscritos</h4></td>
               </tr>  
               <tr>  
                 <td align=\"center\">META SOLUÇÕES</td>
               </tr>  
               <tr>  
                 <td align=\"center\"><h2>MSI - CURSOS</h2></td>
               </tr>  
             </table>
             <table class=\"tbl_header\" width=\"1000\" style='border-top: 1px solid black'>  
               <tr>  
                 <td align=\"center\"><h4 class='text-center'>Gerado em: {$data}</h4></td>
               </tr>
             </table>";
        return $retorno;
    }

    /*
    * Método para montar o Rodapé do relatório em PDF Página: {PAGENO}
    */
    protected function getFooter()
    {
        $rodape = "<table class=\"tbl_footer\" width=\"1000\">  
               <tr>  
                 <td align=\"center\"><b>CNPJ: 10.907.646/0001-00</b><br>RUA: DR ALVES COSTA, 102 - BAIRRO: CENTRO - CIDADE: CARMO - CEP 28.640-000</td>  
               </tr>  
             </table>";
        return $rodape;
    }

    /*
    * Método para construir a tabela em HTML com todos os dados
    * Esse método também gera o conteúdo para o arquivo PDF
    */
    private function getTabela()
    {

        /*
        /*
        $this->pdf = new mPDF(['utf-8', 'A4-L']);
        $this->pdf->SetHTMLHeader($this->getHeader());
        $this->pdf->SetHTMLFooter($this->getFooter());
        $this->pdf->WriteHTML($this->getTabela());
        //$this->pdf->AddPage();
        */

        /*

        $this->comprovantes = $comprovantes;
        $this->morador      = $morador;
        $this->competencia  = $competencia;


                    "produto" => null
            "tipounidade" => null
            "qunatidade" => 0.0
            "valor" => 135.98
            "desconto" => 0.0
            "valortotal" => 135.98

            "fornecedor_id" => 110
    "data" => "2020-01-05"
    "linhadigitavel" => "33200114402247000149650010000022401051214687"
    "valor" => "135.98"
    "desconto" => "0.00"
    "valortotal" => "135.98"
    "observacao" => null

        $this->comprovantes = $comprovantes;
        $this->morador      = $morador;
        $this->competencia  = $competencia;


        $retorno = "";

        $retorno .=
            "<table width='1000' style='padding-top: 80px;border-bottom: 1px solid black'>  
                   <tr>  
                     <td><b>Morador: </b>{$this->morador->nome} {$this->morador->sobrenome}</td>  
                     <td><b>Nome da Residência: </b>{$this->morador->residencia->descricao}</td>  
                   </tr>
                   <tr>  
                     <td colspan='2'><b>Competência: </b></td>  
                   </tr>
               </table>";
        $retorno .=
            "<table width='1000' style='border-bottom: 1px solid black'>  
                   <tr>  
                     <td><b>Banco: </b></td>  
                     <td><b>Agência: </b></td>  
                     <td><b>Conta: </b></td>  
                   </tr>
                   <tr>  
                     <td></td>  
                     <td></td>  
                     <td style='text-align: right'><b>Salto Atual: </b>R$ </td>  
                   </tr>
               </table>";

        return $retorno;
*/
    }

    /*
    * Método para construir o arquivo PDF
    */
    public function BuildPDF()
    {
        $this->pdf = new mPDF( [
            'mode' => '',
            'format' => 'A4',
            'default_font_size' => 0,
            'default_font' => '',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 32,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
            'orientation' => 'P',
        ]);

        $retorno = "";
        $retorno .=
            "<table width='1000' style='padding-top: 20px;'>  
                   <tr>  
                     <td><b>Inscrito</b></td>  
                     <td><b>Data.Insc</b></td>  
                     <td><b>CPF</b></td>  
                     <td><b>E-mail</b></td>  
                     <td><b></b>UF</b></td>  
                     <td><b></b>Status</b></td>  
                     <td><b></b>Total</b></td>  
                   </tr>";
        foreach ($this->data as $key => $dadosIscritos)
        {
            $retorno .=
                "<tr>  
                     <td>".$dadosIscritos->user->name. " " . $dadosIscritos->user->last_name."</td>  
                     <td>".$dadosIscritos->created_at."</td>  
                     <td>".$dadosIscritos->user->aluno->cpf."</td>  
                     <td>".$dadosIscritos->user->email."</td>  
                     <td>".$dadosIscritos->user->aluno->endereco->uf."</td>  
                     <td>".$dadosIscritos->status."</td>  
                     <td>".$dadosIscritos->valor."</td>  
                   </tr>";
        }

        $retorno .= "</td></tr></table>";
        $this->pdf->SetHTMLHeader($this->getHeader());
        $this->pdf->SetHTMLFooter($this->getFooter());
        $this->pdf->WriteHTML($retorno);

        $this->pdf->SetDisplayMode('fullwidth');
        $this->pdf->Output(storage_path("app/public/relatorio/lista-de-usuarios.pdf"),  'F');
    }

    /*
    * Método para exibir o arquivo PDF
    * @param $name - Nome do arquivo se necessário grava-lo
    */
    public function Exibir()
    {
        $this->pdf->SetDisplayMode('fullwidth');
        $this->pdf->Output(storage_path("app/public/relatorio/lista-de-usuarios.pdf"),  'F');
    }
}
