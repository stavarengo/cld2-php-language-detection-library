<?php
namespace Sta\Cld2PhpLanguageDetection;

class DetectionResult
{
    /**
     * @var string
     */
    protected $languageCode;
    /**
     * @var string
     */
    protected $languageName;
    /**
     * @var float
     */
    protected $probability;
    /**
     * @var bool
     */
    protected $confidence = false;

    /**
     * @return string
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * @param string $languageCode
     *
     * @return $this
     */
    public function setLanguageCode($languageCode)
    {
        $this->languageCode = $languageCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguageName()
    {
        return $this->languageName;
    }

    /**
     * @param string $languageName
     *
     * @return $this
     */
    public function setLanguageName($languageName)
    {
        $this->languageName = $languageName;

        return $this;
    }

    /**
     * @return float
     */
    public function getProbability()
    {
        return $this->probability;
    }

    /**
     * @param float $probability
     *
     * @return $this
     */
    public function setProbability($probability)
    {
        $this->probability = $probability;

        return $this;
    }

    /**
     * Alias for {@link \Sta\Cld2PhpLanguageDetection\DetectionResult::getConfidence() }
     *
     * @return bool
     */
    public function isConfidence()
    {
        return $this->getConfidence();
    }

    /**
     * @return bool
     */
    public function getConfidence()
    {
        return $this->confidence;
    }

    /**
     * @param bool $confidence
     *
     * @return $this
     */
    public function setConfidence($confidence)
    {
        $this->confidence = $confidence;

        return $this;
    }

}
