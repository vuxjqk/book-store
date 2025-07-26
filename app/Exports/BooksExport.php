<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BooksExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Book::with('categories')->get()->map(function ($book, $index) {
            return [
                'STT' => $index + 1,
                'Tên sách' => $book->name,
                'Tác giả' => $book->author,
                'Nhà xuất bản' => $book->publishing_house,
                'Ngôn ngữ' => $book->language,
                'Trạng thái' => $book->status,
                'Giá bán' => $book->current_price,
                'Giá gốc' => $book->original_price,
                'Mô tả' => $book->description,
                'Số trang' => $book->page_number,
                'Kích thước' => $book->size,
                'Năm xuất bản' => $book->year_of_publication,
                'Bìa' => $book->cover_type,
                'Tồn kho' => $book->stock,
                'Thể loại' => $book->categories->pluck('name')->implode(', '),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'STT',
            'Tên sách',
            'Tác giả',
            'Nhà xuất bản',
            'Ngôn ngữ',
            'Trạng thái',
            'Giá bán',
            'Giá gốc',
            'Mô tả',
            'Số trang',
            'Kích thước',
            'Năm xuất bản',
            'Bìa',
            'Tồn kho',
            'Thể loại',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
