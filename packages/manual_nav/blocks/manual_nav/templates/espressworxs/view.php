<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
?>

<?php
if (count($rows) > 0) {
    $rows[0]['class'] = "nav-first";
    foreach ($rows as &$rowp) {
        if ($rowp['internalLinkCID'] === $c->getCollectionID()) {
            $rowp['class'] .= " nav-selected";
        }
    }
    ?>
    <ul class="nav-ewr">
        <?php  foreach ($rows as $row) { ?>
            <?php
            // create title
            $title = null;
            if ($row['title'] != null) {
                $title = $row['title'];
            } elseif ($row['collectionName'] != null) {
                $title = $row['collectionName'];
            } else {
                $title = t('');
            }

            $tag = "";
            if ($displayImage != 0) {
                if (is_object($row['image'])) {

                    if($row['isVectorImage']){
//                        $image = Core::make('html/image', array($row['image']));
//                        $tag = $image->getTag();
                        $tag = '<img src="' . $row['image']->getURL() . '" width="25px" height="25px">';
                    } else {
                        $im = Core::make('helper/image');
                        $thumb = $im->getThumbnail($row['image'], 30, 30);
                        $tag = new \HtmlObject\Image();
                        $tag->src($thumb->src)->width($thumb->width)->height($thumb->height);
                        $tag->alt(h($title));
                    }
                }
            }
            ?>

            <li class="<?php  echo $row['class'] ?>">

                <a href="<?php  echo $row['linkURL'] ?>" <?php  echo $row['openInNewWindow']  ?  'target="_blank"' : '' ?>>
                    <?php echo $tag; ?>
                    <?php echo h($title); ?>
                </a>
            </li>
        <?php  } ?>
    </ul>
<?php  } else { ?>
    <div class="ccm-manual-nav-placeholder">
        <p><?php  echo t('No nav Entered.'); ?></p>
    </div>
<?php  } ?>
