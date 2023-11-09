<?php 
class Template
{
    private $content = null;
    public function run($content, $data)
    {
        extract($data);
        if (!empty($content)) {
            $this->content = $content;
            $this->printEntities();
            $this->printRaw();
            $this->ifCondition();
            $this->phpBegin();
            $this->phpEnd();
            eval('?>' . $this->content . '<?php ');
        }
    }
    public function printEntities()
    {
        preg_match_all('~{{\s*(.+?)\s*}}~is', $this->content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key =>  $value) {
                $this->content = str_replace($matches[0][$key], '<?php  echo htmlentities(' . $value . '); ?>', $this->content);
            }
        }
    }
    public function printRaw()
    {
        preg_match_all('~{!\s*(.+?)\s*!}~is', $this->content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key =>  $value) {
                $this->content = str_replace($matches[0][$key], '<?php  echo ' . $value . '; ?>', $this->content);
            }
        }
    }
    public function ifCondition()
    {
        preg_match_all('~@if\s*\((.+?)\s*\)\s*$~im', $this->content, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $key =>  $value) {
                $this->content = str_replace($matches[0][$key], '<?php  if (' . $value . '): ?>', $this->content);
            }
        }
        preg_match_all('~@else\s*$~im', $this->content, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $key =>  $value) {
                $this->content = str_replace($matches[0][$key], '<?php  else: ?>', $this->content);
            }
        }
        preg_match_all('~@endif\s*$~im', $this->content, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $key =>  $value) {
                $this->content = str_replace($matches[0][$key], '<?php  endif; ?>', $this->content);
            }
        }
    }
    public function phpBegin(){
        preg_match_all('~@php~is', $this->content, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $key =>  $value) {
                $this->content = str_replace($matches[0][$key], '<?php  ', $this->content);
            }
        }
    }
    public function phpEnd(){
        preg_match_all('~@endPhp~is', $this->content, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $key =>  $value) {
                $this->content = str_replace($matches[0][$key], '?> ', $this->content);
            }
        }
    }
    public function forLoop(){
        preg_match_all('~@for\s*\((.+?)\s*\)\s*$~im', $this->content, $matches);
        if (!empty($matches[1])) {
            foreach ($matches[1] as $key =>  $value) {
                $this->content = str_replace($matches[0][$key], '<?php  for (' . $value . '): ?>', $this->content);
            }
        }
        preg_match_all('~@endfor\s*$~im', $this->content, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $key =>  $value) {
                $this->content = str_replace($matches[0][$key], '<?php  endfor; ?>', $this->content);
            }
        }
    }
}
?>