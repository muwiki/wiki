<?php



class NetteMailHooks
{

    /**
     * Send a mail using Mailgun API
     *
     * @param array $headers
     * @param array|MailAddress[] $to
     * @param MailAddress $from
     * @param string $subject
     * @param string $body
     * @return bool
     */
    public static function onAlternateUserMailer(
        array $headers,
        array $to,
        MailAddress $from,
        $subject,
        $body
    ) {
        $conf = RequestContext::getMain()->getConfig();

        $mailer = new \Nette\Mail\SmtpMailer($conf->get('NetteSmtp'));

        $message = new \Nette\Mail\Message();
        $message->setFrom($from->address, $from->realName ?: $from->name);
        $message->setSubject($subject);

        $message->setBody($body);

        foreach ($headers as $headerName => $headerValue) {
            $message->setHeader($headerName, $headerValue);
        }

        foreach ($to as $email) {
            try {
                $message->addTo($email->address, $email->realName ?: $email->name);
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        try {
            $mailer->send($message);

        } catch (\Nette\Mail\SmtpException $e) {
            return $e->getMessage();
        }

        return false;
    }

}
