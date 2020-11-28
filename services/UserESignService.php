<?php

namespace app\services;

use Yii;
use yii\base\BaseObject;
use yii\base\InvalidArgumentException;
use yii\helpers\FileHelper;
use app\models\User;

/**
 * Description of UserService
 *
 * @author pky
 */
class UserESignService extends BaseObject {

    /**
     * Путь до пользовательского ключа
     */
    private string $pathCA = '@app/keys/CA';

    /**
     * Путь до пользовательского ключа
     */
    private string $userKeyPath = '@app/keys/user';

    /**
     * FileService constructor.
     * @param array $params
     */
    public function __construct(array $params = []) {
        if (!key_exists('pathCA', $params)) {
            throw new InvalidArgumentException();
        }
        $this->pathCA = $params['pathCA'];

        if (!key_exists('userKeyPath', $params)) {
            throw new InvalidArgumentException();
        }
        $this->userKeyPath = $params['userKeyPath'];
    }

    public function createESignDir(User $user): void {
        $path = $this->getESignPath($user);
        if (!file_exists($path)) {
            FileHelper::createDirectory($path);
        }
    }

    /**
     * @param User $user
     */
    public function deleteESign(User $user): void {
        $path = $this->getESignPath($user);
        if (file_exists($path)) {
            FileHelper::removeDirectory($path);
        }
    }

    /**
     * Путь до файлов с подписью
     * @param User $user
     * @return string
     */
    public function getESignPath(User $user): string {
        return Yii::getAlias($this->userKeyPath . '/' . $user->id);
    }

    public function getCAPath(): string {
        return Yii::getAlias($this->pathCA);
    }

    public function create(User $user) {
        $this->createESignDir($user);
        $eSignPath = $this->getESignPath($user);
        $caPath = $this->getCAPath();
        $this->revoke($user);
        exec("openssl req -nodes -newkey gost2012_512 -keyout $eSignPath/client.key -pkeyopt paramset:A -out $eSignPath/client.csr -subj \"/C=RU/ST=Udm/L=Izhevsk/O=IT/OU=animals/CN=user-{$user->id}\" -config $caPath/openssl.cnf ");
        exec("openssl ca -engine gost -keyfile $caPath/ca.key -cert $caPath/ca.crt -in $eSignPath/client.csr -out $eSignPath/client.crt -batch -config $caPath/openssl.cnf 2>&1", $output);
    }

    public function revoke(User $user) {
        $eSignPath = $this->getESignPath($user);
        if (file_exists("$eSignPath/client.crt")) {
            $caPath = $this->getCAPath();
            exec("openssl ca -config $caPath/openssl.cnf -keyfile $caPath/ca.key -cert $caPath/ca.crt -revoke $eSignPath/client.crt 2>&1", $output);
            exec("openssl ca -gencrl -config $caPath/openssl.cnf -keyfile $caPath/ca.key -cert $caPath/ca.crt -out $caPath/crl.pem 2>&1", $output);
        }
    }

    public function get(User $user): string {
        $eSignPath = $this->getESignPath($user);
        if (file_exists($eSignPath)) {
            exec("openssl x509 -in $eSignPath/client.crt -noout -text", $output);
            return implode('<br>', $output);
        }
        return '';
    }

}
