<?php
namespace hamidreza2005\LaravelApiErrorHandler\Handlers;


abstract class ExceptionHandler
{
    protected $exception;

    protected int $statusCode;

    protected string $message;

    protected array $data;
    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getData()
    {
        return $this->data;
    }
    public function handle(): void
    {
        $this->setMessage();
        $this->setStatusCode();
        $this->setData();
    }
    abstract protected function setStatusCode(): void;

    abstract protected function setMessage(): void;

    protected function setData(): void
    {
        $this->data = [];
    }
}
