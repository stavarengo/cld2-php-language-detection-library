<?php
namespace Sta\Cld2PhpLanguageDetection;

use Sta\Cld2PhpLanguageDetection\Cld2\CLD2Detector;

class DetectLanguage
{
    /**
     * @var string
     */
    protected $text;
    /**
     * @var CLD2Detector
     */
    protected $cld2Detector;

    /**
     * DetectLanguage constructor.
     */
    public function __construct()
    {
        if (class_exists('\CLD2Detector')) {
            $this->cld2Detector = new CLD2Detector();
            $this->cld2Detector->setEncodingHint(\CLD2Encoding::UTF8);
        } else {
            throw new \Sta\Cld2PhpLanguageDetection\Exception\ModuleCld2NotFound('CLD2 extension not installed.');
        }
    }

    /**
     * @param $text
     * @param bool $normalize
     *      Default true.
     *      When true, we will try to remove strings that is not used to make words (eg: HTTP links, emails, emoticons,
     *      symbols, letters mixed with number, etc. See \Sta\Cld2PhpLanguageDetection\DetectLanguage::normalizeText()).
     *
     *      It has advantages and disadvantages, as pointed bellow.
     *      Advantages:
     *          . This can speed up detection.
     *          . Detection result would have less chances of detect multiple languages.
     *      disadvantages:
     *          . We will not be using the original text for detections.
     *
     *      Personally I consider normalization very secure and I always use it in my algorithms, but the option to
     *      disable normalization is here in case you prefer to detect based on the original text.
     *
     * @return DetectionResult[]
     */
    public function detect($text, $normalize = true)
    {
        if (!$text) {
            return [];
        }

        $result = [];
        $text   = $this->text;

        if ($normalize) {
            $text = $this->normalizeText($text);
        }

        $cld2Result = $this->cld2Detector->detect($text);
        if ($cld2Result && is_array($cld2Result)) {
            $result = array_map(
                function (array $cld2ResultItem) {
                    return (new DetectionResult())->setLanguageCode($cld2ResultItem['language_code'])
                                                  ->setLanguageName($cld2ResultItem['language_name'])
                                                  ->setConfidence($cld2ResultItem['is_reliable'])
                                                  ->setProbability($cld2ResultItem['language_probability'] / 100);
                },
                $cld2Result
            );
        }

        return $result;
    }

    /**
     * @param $text
     *
     * @return string
     */
    public function normalizeText($text)
    {
        // Remove emails.
        $text = preg_replace('/\S+@\S+\.\S+/', ' ', $text);
        // Remove HTTP links.
        $text = preg_replace('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i', ' ', $text);
        // Remove any character that is not valid to make words (eg: emoticons, symbols).
        $text = preg_replace('/[^[:alnum:][:alpha:][:ascii:][:cntrl:][:word:]]/u', ' ', $text);
        // Remove numbers and letter mixed with numbers.
        $text = preg_replace('/\b[a-zA-Z]*?[0-9]+[a-zA-Z]*?\b/', ' ', $text);
        // Remove any repeated character in sequence.
        $text = preg_replace("/([^[:alnum:]])\\1{3,}/", ' ', $text);
        // Removes repeated punctuation in sequence.
        $text = preg_replace('/([.,!?\'"%\[\]{}();:|\\\+=])\\1+/', ' ', $text);

        return trim($text);
    }
}
