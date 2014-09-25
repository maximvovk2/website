<?php

Yii::import('bootstrap.widgets.TbGridView');

class BGridView extends TbGridView {


    public function renderPager()
    {
        if (!$this->enablePagination)
            return;
        $pager = array();
        $class = 'CLinkPager';
        if (is_string($this->pager))
            $class = $this->pager;
        else if (is_array($this->pager)) {
            $pager = $this->pager;
            if (isset($pager['class'])) {
                $class = $pager['class'];
                unset($pager['class']);
            }
        }
        $pager['pages'] = $this->dataProvider->getPagination();
        echo '<div class="' . $this->pagerCssClass . '">';

        if ($pager['pages']->getPageCount() > 1) {
            $this->widget($class, $pager);
        }
        else
            $this->widget($class, $pager);
        echo "<br>Per page: ";
        echo CHtml::dropDownList('pageSize', $this->controller->pageSize, array(10 => 10, 20 => 20, 50 => 50, 100 => 100, 500 => 500), array(
            'onchange' => "$.fn.yiiGridView.update('" . $this->id . "',{ data:{pageSize: $(this).val() }})",
        ));
        echo '</div>';
    }


} 