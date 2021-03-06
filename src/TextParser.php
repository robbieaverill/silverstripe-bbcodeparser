<?php

namespace SilverStripe\BBCodeParser;

use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\Core\Object;

/**
 * Parses text in a variety of ways.
 *
 * Called from a template by $Content.Parse(SubClassName), similar to $Content.XML.
 * This will work on any Text database field (Or a sub-class, such as HTMLText,
 * although it's usefulness in this situation is more limited).
 *
 * Any sub-classes of TextParser must implement a parse() method.
 * This should take $this->content and parse it however you want. For an example
 * of the implementation, @see BBCodeParser.
 *
 * Your sub-class will be initialized with a string of text, then parse() will be called.
 * parse() should (after processing) return the formatted string.
 *
 * Note: $this->content will have NO conversions applied to it.
 * You should run Covert::raw2xml or whatever is appropriate before using it.
 *
 * Optionally (but recommended), is creating a static usable_tags method,
 * which will return a SS_List of all the usable tags that can be parsed.
 * This will (mostly) be used to create helper blocks - telling users what things will be parsed.
 * Again, @see BBCodeParser for an example of the syntax
 *
 * @todo Define a proper syntax for (or refactor) usable_tags that can be extended as needed.
 */
abstract class TextParser extends Object
{

    /**
     * @var string
     */
    protected $content;

    /**
     * Creates a new TextParser object.
     *
     * @param string $content The contents of the dbfield
     */
    public function __construct($content = "")
    {
        parent::__construct();
        $this->content = $content;
        parent::__construct();
    }

    /**
     * Convenience method, shouldn't really be used, but it's here if you want it
     *
     * @param string $content
     */
    public function setContent($content = "")
    {
        $this->content = $content;
    }

    /**
     * Define your own parse method to parse $this->content appropriately.
     * See the class doc-block for more implementation details.
     *
     * @return DBField
     */
    abstract public function parse();
}
