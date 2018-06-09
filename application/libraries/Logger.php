<?php

class Logger {

    private $rep;
    private $ready;

    const GRAN_VOID = 'VOID';
    const GRAN_MONTH = 'MONTH';
    const GRAN_YEAR = 'YEAR';

    public function __construct(array $params)
    {

        $this->ready = false;

        if (!is_dir($params['path'])) {
            trigger_error("le chemin specifie n'existe pas", E_USER_WARNING);
            return false;
        }

        $this->rep = realpath($params['path']);
        $this->ready = true;
        
        return true;

    }

    /**
     * Definti un chein pour les archivages de log
     * @param string $type
     * @param string $name
     * @param string $gran
     * @return bool|string
     */
    public function path(string $type, string $name, $gran = self::GRAN_YEAR)
    {
        #je verifie si le dossier existe
        if (!$this->ready) {
            trigger_error("le logger n'a pas de dossier valide", E_USER_WARNING);
            return false;
        }

        if (!isset($type) && empty($name)) {
            trigger_error("Parametres incorrect", E_USER_WARNING);
            return false;
        }

        if (empty($type)) {
            $type_path = $this->rep.'/';
        } else {
            $type_path = $this->rep.'/'.$type.'/';
            if (!is_dir($type_path)) {
                mkdir($type_path, 0755);
            }
        }

        switch ($gran) {
            case self::GRAN_VOID:
                $logfile = $type_path.$name.'.log';

                break;
            case self::GRAN_MONTH:

                $mois_courant = date('Ym');
                $type_path_mois = $type_path.$mois_courant;
                if (!is_dir($type_path_mois)) {
                    echo $type_path_mois;
                }
                $logfile = $type_path_mois.'/'.$mois_courant.'_'.$name.'.log';
                break;

            case self::GRAN_YEAR:
                $current_year = date('Y');
                $type_path_year = $type_path.$current_year;
                if (!is_dir($type_path_year)) {
                    mkdir($type_path_year, 0755);
                }
                $logfile = $type_path_year.'/'.$current_year.'_'.$name.'.log';
                break;

            default:
                trigger_error("Cette granularite '$gran' nest pas pris en charge ", E_USER_WARNING);
                return false;

        }
        return $logfile;
    }

    /**
     * Permet de creer le log
     * @param string $type
     * @param string $name
     * @param string $line
     * @param string $gran
     * @return bool
     *
     */
    public function log(string $type, string $name, string $line, $gran = self::GRAN_YEAR)
    {
        if (!isset($type) || empty($name) || empty($line)) {
            trigger_error("Pareametres incorrects", E_USER_WARNING);
            return false;
        }

        $logfile = $this->path($type, $name ,$gran);

        echo $logfile;

        if ($logfile === false) {
            trigger_error("Impossible d'enregistrer le log", E_USER_WARNING);
            return false;
        }

        $line = date('d/m/Y H:i:s').' '.$line;

        if (!preg_match('#\n$#', $line)) {
            $line .= "\n";
        }

        $this->write($logfile, $line);
    }

    /**
     * Ecrit dans le fichier de log
     * @param $logfile
     *
     * @param $line
     * @return bool
     * */

    private function write($logfile, $line)
    {
        if (!$this->ready) return false;

        if (empty($logfile)) {
            trigger_error("le logfile est vide", E_USER_WARNING);
            return false;
        }

        $file = fopen($logfile, 'a+');
        fputs($file, $line);
        fclose($file);
    }

	public function getRep()
	{
		return $this->rep;
    }

}
