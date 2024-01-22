import { Pipe, PipeTransform } from "@angular/core";

@Pipe({
    name: 'skratiText'
})

export class SkratiTextPipe implements PipeTransform {
    
    transform(text: string, maxLength: number = 50) {
        if (text.length <= maxLength) {
            return text;
        } else {
            return text.substring(0, maxLength) + '...';
        }
    }
}