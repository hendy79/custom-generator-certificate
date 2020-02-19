<?php
    /*
    MIT License

    Copyright (c) 2020 Hendy (M. Khoiri Muzaki, Alland C. Kesuma)

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
    */
	class CsvReader
	{
		private $csv;
		private	$is_title;
		private $length;
		private	$delimiter;
		private	$enclosure;
		private	$escape;
		private $f_name;
		private $c_rows;

		function __construct($csv, $is_title = false, $length = 0, $delimiter = ';', $enclosure = '"', $escape = "\\")
		{
			$tmp = explode('.', $csv['name']);
			$extension = end($tmp);
			if($extension !== 'csv' && $csv['name']!=null)
			{
				exit('No CSV file.');
			}
			$this->csv = $csv;
			$this->is_title = $is_title;
			$this->length = $length;
			$this->delimiter = $delimiter;
			$this->enclosure = $enclosure;
			$this->escape = $escape;
			$this->f_name = $csv['name'];
		}

		public function set_is_title($is_title)
		{
			$this->is_title = $is_title;
		}

		public function set_length($length)
		{
			$this->length = $length;
		}

		public function set_delimiter($delimiter)
		{
			$this->delimiter = $delimiter;
		}

		public function set_enclosure($enclosure)
		{
			$this->enclosure = $enclosure;
		}

		public function set_escape($escape)
		{
			$this->escape = $escape;
		}

		public function get_is_title()
		{
			return $this->is_title;
		}

		public function get_length()
		{
			return $this->length;
		}

		public function get_delimiter()
		{
			return $this->delimiter;
		}

		public function get_enclosure()
		{
			return $this->enclosure;
		}

		public function get_escape()
		{
			return $this->escape;
		}

		public function get_file_name()
		{
			return $this->f_name;
		}

		public function get_rows_count()
		{
			return $this->c_rows;
		}

		public function read()
		{
			$this->c_rows = 1;
			$results = array();

			if (($handle = fopen($this->csv['tmp_name'], "r")) !== FALSE)
			{
				while (($data = fgetcsv($handle, $this->length, $this->delimiter, $this->enclosure, $this->escape)) !== FALSE)
				{
					$results[] = $data;

					$this->c_rows++;
				}

				fclose($handle);
			}

			return $results;
		}

		public function dataread($temp_v)
		{
			$this->c_rows = 1;
			$results = array();

			if (($handle = fopen($temp_v, "r")) !== FALSE)
			{
				while (($data = fgetcsv($handle, $this->length, $this->delimiter, $this->enclosure, $this->escape)) !== FALSE)
				{
					$results[] = $data;

					$this->c_rows++;
				}

				fclose($handle);
			}

			return $results;
		}

		public function print_table($values ,$class = '', $id = '')
		{
			$print = '';
			$count = 0;
			$row = 1;
			$collumn = count($values[0]);

			$print .= '<form method="post">';

			$print .= '<div class="table-responsive"><table class="table" id="table">';

			$print .= '<tr class="table-info">';
			while($count < $collumn){
				$print .= '<td><input type="checkbox" value="'.$count.'" class="big-checkbox" name="Kolom[]"/></td>';
				$count++;
				if($count == $collumn){
					$print .= '<td>Choose</td>';
				}
			}
			$print .= '</tr>';
			
			$count = 1;
			
			foreach ($values as $value)
			{
				if($count == 1){
					$print .= '<thead>';
				}
				$print .= '<tr>';

				foreach ($value as $v)
				{
					if($count === 1 && $this->is_title === true){
						$print .= "<th>$v</th>";
					}else{
						$print .= "<td>$v</td>";}
				}
				if($count !== 1){
					$print .= '<td class="table-info"><input type="checkbox" value="'.($count-1).'" class="big-checkbox" name="Baris[]"/></td>';
				}else{
					$print .= '<td></td>';
				}

				$print .= '</tr>';
				if($count == 1){
					$print .= '</thead>';
				}

				$count++;
			}
			$print .= '</table></div><button type="submit" onClick="return confirm(\'Are you sure you want to delete? (This Change Cannot be Undone!)\')" name="submit" class="btn waves-effect waves-light btn-danger">Delete Selection</button>
			<button type="submit" onClick="return confirm(\'Are you sure you want to continue? (This Change Cannot be Undone!)\')" name="submit1" class="btn waves-effect waves-light btn-success ml-1">Submit</button></form>';

			return $print;
		}
	}
?>