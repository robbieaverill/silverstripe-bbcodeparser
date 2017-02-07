<?php

use SilverStripe\Dev\SapphireTest;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\Parsers\BBCodeParser;
use SilverStripe\View\Parsers\ShortcodeParser;

/**
 * @package bbcodeparser
 * @subpackage tests
 */
class DBHTMLTextTest extends SapphireTest
{
    /**
     * Register shortcode
     */
    public function setUp()
    {
        ShortcodeParser::get('default')->register('bbcodeparser_shortcode', array(self::class, 'DummyShortCode'));
        return parent::setUp();
    }

    /**
     * Unregister shortcode
     */
    public function tearDown()
    {
        ShortcodeParser::get('default')->unregister('bbcodeparser_shortcode');
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    /**
     * @covers {@link BBCodeParser}
     */
    public function testParse()
    {
        // Test parse
        /** @var DBHTMLText $obj */
        $html = DBField::create_field(
            'HTMLText',
            '<p>[b]Some content[/b] [bbcodeparser_shortcode] with shortcode</p>'
        );

        /** @var BBCodeParser $obj */
        $obj = BBCodeParser::create($html->RAW());

        // BBCode strips HTML and applies own formatting
        $this->assertEquals(
            '<strong>Some content</strong> shortcode content with shortcode',
            $obj->parse()->forTemplate()
        );
    }

    /**
     * @return string
     */
    public static function DummyShortCode()
    {
        return 'shortcode content';
    }
}
