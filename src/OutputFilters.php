<?php

namespace Mnvx\Lowrapper;

class OutputFilters
{
    /**
     * More filters: https://wiki.openoffice.org/wiki/Framework/Article/Filter/FilterList_OOo_3_0
     */
    const TEXT_ENCODED = 'Text (encoded)';
    const UTF8 = 'UTF8';

    /**
     * Default filters for output formats
     * @param string $outputFormat
     * @return array
     */
    public static function getDefault(/*string*/ $outputFormat)
    {
        switch ($outputFormat) {
            case Format::TEXT_TEXT:
                return [
                    static::TEXT_ENCODED,
                    static::UTF8,
                ];
        }

        return [];
    }
}