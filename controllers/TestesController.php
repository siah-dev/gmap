<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Html;
use yii\filters\AccessControl;
use app\models\Estabelecimento;
use app\models\Leitos;
use app\models\LeitoTipo;
use app\models\LeitosUnidades;
use app\models\UnidadesSaude;

use yii\db\Connection;

class TestesController extends Controller
{
	public function actionTeste(){
		$teste = [1,2,3];
		$connection = Yii::$app->db;
		$id = 330;
		$teste = $connection->createCommand('SELECT SUM(LT_qnt) as leitos, SUM(LT_qnt_sus) as leitos_SUS, esp.descricao
											FROM leitos_unidades lu
											INNER JOIN leito_tipo lt ON lt.id = lu.leito_tipo
											INNER JOIN especialidade_leito esp ON lt.esp_leito = esp.codigo
											INNER JOIN unidades_saude us ON us.id = lu.id_unidade
											WHERE lu.id_unidade = :id_unidade
											GROUP BY esp.descricao')
											->bindValues([':id_unidade'=>$id])
											->queryAll();

			return $this->render('testes',['teste'=>$teste]);
		}
		public function actionDatasus(){
			
		}
}
