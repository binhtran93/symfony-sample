<?php


namespace App\Serializer;


class FormExceptionNormalizer
{
    /**
     * @param FormException $exception
     * @param null          $format
     * @param array         $context
     *
     * @return array|bool|float|int|string|void
     */
    public function normalize($exception, $format = null, array $context = [])
    {
        $data   = [];
        $errors = $exception->getErrors();

        foreach ($errors as $error) {
            $data[$error->getOrigin()->getName()][] = $error->getMessage();
        }

        return $data;
    }

    /**
     * @param mixed $data
     * @param null  $format
     *
     * @return bool|void
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof FormException;
    }
}