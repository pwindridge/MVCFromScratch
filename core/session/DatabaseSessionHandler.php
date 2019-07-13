<?php


namespace Core\Session;


use SessionHandlerInterface, PDOException;
use \Core\App;


/**
 * Class DatabaseSessionHandler
 * @package Core\Session
 */
class DatabaseSessionHandler implements SessionHandlerInterface {

    /**
     * DatabaseSessionHandler constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        App::get('PDOConn')->query(
            "CREATE TABLE IF NOT EXISTS `sessions` (" .
            " `sess_id` char(40) NOT NULL," .
            " `sess_data` text NOT NULL," .
            " `modified` int(11) NOT NULL," .
            " UNIQUE KEY `sess_id` (`sess_id`)" .
            ") ENGINE=InnoDB DEFAULT CHARSET=latin1; "
        );
        session_set_save_handler($this);
        session_start();
    }

    /**
     * @return bool
     */
    public function close()
    {
        return true;
    }

    /**
     * @param string $session_id
     * @return bool
     * @throws \Exception
     */
    public function destroy($session_id)
    {
        App::get('database')->delete('sessions')
            ->where('sess_id', '=', $session_id)
            ->execute();
        return true;
    }

    /**
     * @param int $maxlifetime
     * @return bool
     * @throws \Exception
     */
    public function gc($maxlifetime)
    {
        App::get('database')->delete('sessions')
            ->where('modified', '<', time() - $maxlifetime)
            ->execute();
        return true;
    }

    /**
     * @param string $save_path
     * @param string $name
     * @return bool
     */
    public function open($save_path, $name)
    {
        return true;
    }

    /**
     * @param string $session_id
     * @return string
     * @throws \Exception
     */
    public function read($session_id)
    {
        $session = App::get('database')->select('sessions', ['sess_data'])
            ->where('sess_id', '=', $session_id)
            ->execute()
            ->fetch();

        return $session ? $session->sess_data : '';
    }

    /**
     * @param string $session_id
     * @param string $session_data
     * @return bool
     * @throws \Exception
     */
    public function write($session_id, $session_data)
    {
        try {
            App::get('database')->insert('sessions', [
                'sess_id' => $session_id,
                'sess_data' => $session_data,
                'modified' => time()
            ]);
        } catch (PDOException $pexc) {
            if ($pexc->getCode() == 23000) { // session id already exists
                App::get('database')->update('sessions', [
                    'sess_data' => $session_data,
                    'modified' => time()
                ])
                    ->where('sess_id', '=', $session_id)
                    ->execute();
            }
        }
        return true;
    }
}