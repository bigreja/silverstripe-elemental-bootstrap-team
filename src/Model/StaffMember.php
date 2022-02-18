<?php

namespace bigreja\SilverStripeElementalBootstrapStaffSection\Model;

use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\FieldList;
use SilverStripe\AssetAdmin\Forms\UploadField;
use syntro\SilverStripeElementalBaseitems\Model\BaseItem;
use bigreja\SilverStripeElementalBootstrapStaffSection\Elements\StaffSection;

/**
 * StaffMember
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class StaffMember extends BaseItem
{
    /**
     * @var string
     */
    private static $table_name = 'ElementalBootstrapStaffMember';

    /**
     * @var array
     */
    private static $db = [
        'Sort' => 'Int',
        'Position' => 'Varchar(255)',
        'ORCID' => 'Varchar(50)',
        'Contact' => 'Varchar(255)',
        'Content' => 'HTMLText',

    ];

    private static $default_sort = ['Sort' => 'ASC'];

    /**
     * @var array
     */
    private static $has_one = [
        'Section' => StaffSection::class,
        'Image' => Image::class,
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Image'
    ];

    private static $defaults = [
        'ShowTitle' => true
    ];

    private static $summary_fields = [
        'Image.StripThumbnail',
        'Title',
        'Position'
    ];

    /**
     * fieldLabels - apply labels
     *
     * @param  boolean $includerelations = true
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Image.StripThumbnail'] = _t(__CLASS__ . '.IMAGE', 'Image');
        $labels['Image'] = _t(__CLASS__ . '.IMAGE', 'Image');
        $labels['Title'] = _t(__CLASS__ . '.TITLE', 'Name');
        $labels['Position'] = _t(__CLASS__ . '.POSITION', 'Position');
        $labels['Contact'] = _t(__CLASS__ . '.CONTACT', 'Contact');
        $labels['Content'] = _t(__CLASS__ . '.CONTENT', 'Content');
        $labels['ORCID'] = _t(__CLASS__ . '.ORCID', 'ORCID');
        return $labels;
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            /** @var FieldList $fields */
            $fields->removeByName([
                'Sort',
                'SectionID',
                'Title',
                'ShowTitle',
                'Name'
            ]);

            // Add title field
            $fields->addFieldToTab(
                'Root.Main',
                TextField::create(
                    'Title',
                    $this->fieldLabel('Title')
                ),
                'Position'
            );

            // Add Image Upload Field
            $fields->addFieldToTab(
                'Root.Main',
                $imageField = UploadField::create(
                    'Image',
                    $this->fieldLabel('Image')
                ),
                'Position'
            );
            $imageField->setFolderName('Uploads/StaffMembers');

            $fields->addFieldToTab(
                'Root.Main',
                TextField::create(
                    'Contact',
                    $this->fieldLabel('Contact')
                ),
                'Contact'
            );
            $fields->addFieldToTab(
                'Root.Main',
                TextField::create(
                    'ORCID',
                    $this->fieldLabel('ORCID')
                ),
                'ORCID'
            );
            $fields->addFieldToTab(
                'Root.Main',
                HTMLEditorField::create(
                    'Content',
                    $this->fieldLabel('Content')
                ),
                'Content'
            );

        });

        return parent::getCMSFields();
    }
}
