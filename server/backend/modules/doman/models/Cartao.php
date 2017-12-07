<?php

namespace app\modules\doman\models;

use \app\modules\doman\models\base\Cartao as BaseCartao;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use common\models\Util;
use \common\components\traits\SimpleStatusInterface;
use common\components\traits\ConvocacaoStatusInterface;
/**
 * This is the model class for table "cartao".
 */
class Cartao extends BaseCartao implements SimpleStatusInterface, ConvocacaoStatusInterface {

    use \common\components\traits\SimpleStatusTrait;
    use \common\components\traits\ConvocacaoStatusTrait;
    
    const IMAGENS_PATH = 'imagens/';

    /**
     * @var UploadedFile
     */
    public $imagem;    

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nome', 'atividade_id', 'user_id', 'ordem'], 'required'],
            [['status', 'ordem', 'atividade_id', 'user_id', 'user_publicacao_id', 'status_convocacao', 'som_id'], 'integer'],
            [['data_criacao', 'data_publicacao'], 'safe'],
            [['deletado'], 'boolean'],
            [['nome'], 'string', 'max' => 255],
            [['imagem_caminho', 'imagem'], 'safe'],
            [['imagem'], 'file', 'maxSize' => 1024 * 1024 * 1024 * 1],
            ['imagem', 'image', 'extensions' => 'jpg, png',
                'minWidth' => 1024, 'maxWidth' => 1024,
                'minHeight' => 768, 'maxHeight' => 768,
        ]];
    }

    /**
     * save imagem
     * @return boolean
     */
    public function upload() {

        if ($this->isNewRecord || !is_null($this->imagem)) {
            if ($this->validate()) {
                $ext = end((explode(".", $this->imagem->name)));
                // generate a unique file name to prevent duplicate filenames
                $fileName = Util::generateHashSha256(6) . "_" . Util::sanitizeString($this->imagem->baseName) . ".{$ext}";
                $this->imagem_caminho = Cartao::IMAGENS_PATH . strtolower($fileName);
                if($this->isNewRecord && is_null($this->imagem)){
                    $this->addError('imagem_caminho', 'O arquivo de imagem é obrigatório.');
                    return false;
                }else{
                    $this->imagem->saveAs($this->imagem_caminho, false);
                }                
                return $this->save();
            } else {
                return false;
            }
        }
        return $this->save();
    }

    public function behaviors() {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'deletado' => true
                ],
                'replaceRegularDelete' => true // mutate native `delete()` method
            ],
            'normalizador' => [
                'class' => \common\components\behaviors\NormalizadorBehavior::className(),            
            ],
            'pdf' => [
                'class' => behaviors\AtividadePDFBehavior::className(),
            ],
        ];
    }

}
