export interface ModelFactory<T> {
    createDefault(): T;
}